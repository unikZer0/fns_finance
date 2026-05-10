<?php

namespace App\Http\Controllers\HeadOfFinance;

use App\Http\Controllers\Controller;
use App\Models\AcademicIncomePlan;
use App\Models\AppSetting;
use App\Models\ExpenseDefault;
use App\Models\ExpenseItem;
use App\Models\ExpensePlan;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    private array $categoryTitles = [
        '2.1' => '2.1  ລາຍຈ່າຍບໍລິຫານປົກກະຕິ',
        '2.2' => '2.2  ລາຍຈ່າຍປັບປຸງ ແລະ ສົ່ງເສີມວິຊາການ',
        '2.3' => '2.3  ລາຍຈ່າຍດັດສົມ, ສົ່ງເສີມ ແລະ ບຳລຸງຮັກສາ',
        '2.4' => '2.4  ລາຍຈ່າຍອຸດໜູນກົງຈັກ',
        '2.5' => '2.5  ຄ່າສິດສອນ ແລະ ການປະເມີນ',
        '2.6' => '2.6  ລາຍຈ່າຍນອກຫຼັກສູດ',
    ];

    // ─── Plans CRUD ───────────────────────────────────────────────────────────

    public function index()
    {
        $plans = ExpensePlan::with('creator')
            ->orderByDesc('fiscal_year')
            ->get();

        return view('head_of_finance.expense.index', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fiscal_year' => 'required|integer|min:2000|max:9999|unique:expense_plans,fiscal_year',
        ]);

        $plan = ExpensePlan::create([
            'fiscal_year' => $request->fiscal_year,
            'status'      => 'DRAFT',
            'created_by'  => auth()->id(),
        ]);

        $this->seedDefaults($plan);

        return redirect()->route('head_of_finance.expense.show', $plan)
            ->with('success', 'ສ້າງແຜນລາຍຈ່າຍສຳເລັດ!');
    }

    public function show(ExpensePlan $plan)
    {
        $plan->load('items');

        $sections = [];
        foreach (array_keys($this->categoryTitles) as $cat) {
            $sections[$cat] = $plan->items
                ->where('category_code', $cat)
                ->sortBy('sort_order')
                ->values();
        }

        return view('head_of_finance.expense.show', compact('plan', 'sections') + [
            'categoryTitles' => $this->categoryTitles,
        ]);
    }

    public function destroy(ExpensePlan $plan)
    {
        $plan->items()->delete();
        $plan->delete();

        return redirect()->route('head_of_finance.expense.index')
            ->with('success', 'ລຶບແຜນລາຍຈ່າຍສຳເລັດ!');
    }

    // ─── Bulk save ────────────────────────────────────────────────────────────

    public function saveAll(Request $request, ExpensePlan $plan)
    {
        foreach ($request->input('items', []) as $id => $data) {
            $item = ExpenseItem::where('plan_id', $plan->id)->find($id);
            if (!$item) continue;

            $item->update([
                'amount_per_month' => max(0, (float) ($data['amount_per_month'] ?? 0)),
                'num_months'       => max(0, (float) ($data['num_months']       ?? 12)),
            ]);
        }

        return back()->with('success', 'ບັນທຶກສຳເລັດ!');
    }

    // ─── Approve / Revert ─────────────────────────────────────────────────────

    public function approve(ExpensePlan $plan)
    {
        $plan->update(['status' => 'APPROVED']);

        return redirect()->route('head_of_finance.expense.show', $plan)
            ->with('success', 'ອະນຸມັດແຜນລາຍຈ່າຍສຳເລັດ!');
    }

    public function revertDraft(ExpensePlan $plan)
    {
        $plan->update(['status' => 'DRAFT']);

        return redirect()->route('head_of_finance.expense.show', $plan)
            ->with('success', 'ຍ້ອນກັບສູ່ຮ່າງສຳເລັດ!');
    }

    // ─── Auto-fill 2.5 from income plan ──────────────────────────────────────

    public function autoFill25(ExpensePlan $plan)
    {
        $incomePlan = AcademicIncomePlan::where('fiscal_year', $plan->fiscal_year)
            ->with('items')
            ->first();

        if (!$incomePlan) {
            return back()->with('error', 'ບໍ່ພົບແຜນລາຍຮັບ ສົກ ' . $plan->fiscal_year);
        }

        $ppc        = (float) AppSetting::get('price_per_credit', 35000);
        $rateBsc    = (float) AppSetting::get('teaching_rate_bachelor', 0.40);
        $rateMsc    = (float) AppSetting::get('teaching_rate_masters_phd', 0.60);

        $teaching = 0;
        foreach ($incomePlan->items->whereIn('section_code', ['1.1', '1.3']) as $item) {
            $rate   = ($item->student_year === 'masters_phd') ? (float)$item->rate_per_person : (float)$item->num_credits * $ppc;
            $kawt   = $rate * $item->num_persons * (1 - $item->nuol_percentage);
            $tr     = ($item->student_year === 'masters_phd') ? $rateMsc : $rateBsc;
            $teaching += $kawt * $tr;
        }

        $item25 = $plan->items()
            ->where('category_code', '2.5')
            ->where('reference', '2.5.1')
            ->first();

        if ($item25) {
            $item25->update([
                'amount_per_month' => round($teaching / 12, 2),
                'num_months'       => 12,
            ]);
        }

        return back()->with('success', sprintf(
            'ຕັ້ງຄ່າ 2.5.1 = %s ກີບ/ເດືອນ (ຈາກລາຍຮັບ)',
            number_format($teaching / 12, 0, '.', ',')
        ));
    }

    // ─── Summary / PDF ────────────────────────────────────────────────────────

    public function summary(ExpensePlan $plan)
    {
        $plan->load('items');
        [$sections, $rows, $grandTotal] = $this->buildSummaryData($plan);

        return view('head_of_finance.expense.summary', compact(
            'plan', 'sections', 'rows', 'grandTotal'
        ) + ['categoryTitles' => $this->categoryTitles]);
    }

    public function exportPdf(ExpensePlan $plan)
    {
        $plan->load('items');
        [$sections, $rows, $grandTotal] = $this->buildSummaryData($plan);

        $html = view('head_of_finance.expense.summary', compact(
            'plan', 'sections', 'rows', 'grandTotal'
        ) + ['categoryTitles' => $this->categoryTitles])->render();

        $defaultConfig     = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs          = $defaultConfig['fontDir'];
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData          = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4-L',
            'margin_left'   => 10,
            'margin_right'  => 10,
            'margin_top'    => 12,
            'margin_bottom' => 12,
            'fontDir'  => array_merge($fontDirs, [storage_path('fonts')]),
            'fontdata' => $fontData + [
                'notosanslao' => [
                    'R' => 'NotoSansLao-Regular.ttf',
                    'B' => 'NotoSansLao-Bold.ttf',
                ],
            ],
            'default_font' => 'notosanslao',
        ]);

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont   = true;
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="ຮ່າງສັງລວມລາຍຈ່າຍ_' . $plan->fiscal_year . '.pdf"');
    }

    // ─── Defaults management ──────────────────────────────────────────────────

    public function defaults()
    {
        $grouped = ExpenseDefault::orderBy('category_code')->orderBy('sort_order')
            ->get()->groupBy('category_code');

        return view('head_of_finance.expense.defaults', [
            'grouped'        => $grouped,
            'categoryTitles' => $this->categoryTitles,
        ]);
    }

    public function storeDefault(Request $request)
    {
        $request->validate([
            'category_code'    => 'required|in:2.1,2.2,2.3,2.4,2.5,2.6',
            'item_name'        => 'required|string|max:255',
            'reference'        => 'nullable|string|max:10',
            'amount_per_month' => 'required|numeric|min:0',
            'num_months'       => 'required|numeric|min:0',
            'notes'            => 'nullable|string|max:255',
        ]);

        $maxOrder = ExpenseDefault::where('category_code', $request->category_code)->max('sort_order') ?? -1;

        ExpenseDefault::create([
            'category_code'    => $request->category_code,
            'sort_order'       => $maxOrder + 1,
            'item_name'        => $request->item_name,
            'reference'        => $request->reference,
            'amount_per_month' => $request->amount_per_month,
            'num_months'       => $request->num_months,
            'notes'            => $request->notes,
        ]);

        return back()->with('success', 'ເພີ່ມ Default ສຳເລັດ!');
    }

    public function destroyDefault(ExpenseDefault $default)
    {
        $default->delete();
        return back()->with('success', 'ລຶບ Default ສຳເລັດ!');
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function seedDefaults(ExpensePlan $plan): void
    {
        $counters = [];
        foreach (ExpenseDefault::orderBy('category_code')->orderBy('sort_order')->get() as $d) {
            $cat = $d->category_code;
            $counters[$cat] = ($counters[$cat] ?? -1) + 1;

            ExpenseItem::create([
                'plan_id'          => $plan->id,
                'category_code'    => $cat,
                'sort_order'       => $counters[$cat],
                'item_name'        => $d->item_name,
                'reference'        => $d->reference,
                'amount_per_month' => $d->amount_per_month,
                'num_months'       => $d->num_months,
                'notes'            => $d->notes,
            ]);
        }
    }

    private function buildSummaryData(ExpensePlan $plan): array
    {
        $sections = [];
        $rows     = [];

        foreach (array_keys($this->categoryTitles) as $cat) {
            $items = $plan->items->where('category_code', $cat)->sortBy('sort_order')->values();
            $total = $items->sum(fn($i) => $i->amount_per_month * $i->num_months);
            $sections[$cat] = $items;
            $rows[$cat]     = [
                'label' => $this->categoryTitles[$cat],
                'total' => $total,
            ];
        }

        $grandTotal = array_sum(array_column($rows, 'total'));

        return [$sections, $rows, $grandTotal];
    }
}
