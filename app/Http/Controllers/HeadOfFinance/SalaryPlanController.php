<?php

namespace App\Http\Controllers\HeadOfFinance;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Models\SalaryDefault;
use App\Models\SalaryPlan;
use App\Models\SalaryPlanItem;
use Illuminate\Http\Request;

class SalaryPlanController extends Controller
{
    // Ordered sections for grouping and display
    private array $sectionMeta = [
        '60.10' => 'ເງິນເດືອນພື້ນຖານ',
        '60.20' => 'ເງິນອຸດໜູນປົກກະຕິ',
        '61.20' => 'ເງິນອຸດໜູນຄອບຄົວ',
        '61.30' => 'ກ່ອນຮັບບໍານານ',
        '61.40' => 'ວຽກເພີ້ມ ແລະ ນະໂຍບາຍອື່ນໆ',
        '61.50' => 'ເບ້ຍລ້ຽງນັກຮຽນ',
    ];


    // ─── Plans CRUD ───────────────────────────────────────────────────────────

    public function index()
    {
        $plans = SalaryPlan::with('creator')
            ->orderByDesc('fiscal_year')
            ->get();

        return view('head_of_finance.salary.index', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fiscal_year' => 'required|integer|min:2000|max:9999|unique:salary_plans,fiscal_year',
        ]);

        $plan = SalaryPlan::create([
            'fiscal_year' => $request->fiscal_year,
            'status'      => 'DRAFT',
            'created_by'  => auth()->id(),
        ]);

        $this->seedDefaults($plan);

        return redirect()->route('head_of_finance.salary.show', $plan)
            ->with('success', 'ສ້າງແຜນເງິນເດືອນສຳເລັດ!');
    }

    public function show(SalaryPlan $plan)
    {
        $plan->load('items');
        [$sections, $totals] = $this->buildSections($plan->items);

        return view('head_of_finance.salary.show', compact('plan', 'sections', 'totals') + [
            'sectionMeta' => $this->sectionMeta,
        ]);
    }

    public function destroy(SalaryPlan $plan)
    {
        $plan->items()->delete();
        $plan->delete();

        return redirect()->route('head_of_finance.salary.index')
            ->with('success', 'ລຶບແຜນເງິນເດືອນສຳເລັດ!');
    }

    // ─── Bulk save ────────────────────────────────────────────────────────────

    public function saveAll(Request $request, SalaryPlan $plan)
    {
        foreach ($request->input('items', []) as $id => $data) {
            $item = SalaryPlanItem::where('plan_id', $plan->id)->find($id);
            if (!$item) continue;

            $item->update([
                'num_persons' => max(0, (int)   ($data['num_persons'] ?? 0)),
                'amount_atm'  => max(0, (float) ($data['amount_atm']  ?? 0)),
                'amount_cash' => max(0, (float) ($data['amount_cash'] ?? 0)),
            ]);
        }

        return back()->with('success', 'ບັນທຶກສຳເລັດ!');
    }

    // ─── Approve / Revert ─────────────────────────────────────────────────────

    public function approve(SalaryPlan $plan)
    {
        $plan->update(['status' => 'APPROVED']);

        return redirect()->route('head_of_finance.salary.show', $plan)
            ->with('success', 'ອະນຸມັດແຜນເງິນເດືອນສຳເລັດ!');
    }

    public function revertDraft(SalaryPlan $plan)
    {
        $plan->update(['status' => 'DRAFT']);

        return redirect()->route('head_of_finance.salary.show', $plan)
            ->with('success', 'ຍ້ອນກັບສູ່ຮ່າງສຳເລັດ!');
    }

    // ─── Summary / PDF ────────────────────────────────────────────────────────

    public function summary(SalaryPlan $plan)
    {
        $plan->load('items');
        [$sections, $totals] = $this->buildSections($plan->items);

        return view('head_of_finance.salary.summary', compact(
            'plan', 'sections', 'totals'
        ) + ['sectionMeta' => $this->sectionMeta]);
    }

    public function exportPdf(SalaryPlan $plan)
    {
        $plan->load('items');
        [$sections, $totals] = $this->buildSections($plan->items);

        $html = view('head_of_finance.salary.summary', compact(
            'plan', 'sections', 'totals'
        ) + ['sectionMeta' => $this->sectionMeta])->render();

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
            ->header('Content-Disposition', 'inline; filename="ແຜນເງິນເດືອນ_' . $plan->fiscal_year . '.pdf"');
    }

    // ─── Defaults management ──────────────────────────────────────────────────

    public function defaults()
    {
        // All parent accounts from chart_of_accounts (any that have children)
        $sectionAccounts = ChartOfAccount::whereHas('children')
            ->with(['children' => fn($q) => $q->orderBy('account_code')])
            ->orderBy('account_code')
            ->get();

        // Index by dot-notation section_code for label lookups in the view
        $sectionIndex = $sectionAccounts->keyBy(
            fn($a) => substr($a->account_code, 0, 2) . '.' . substr($a->account_code, 2, 2)
        );

        $grouped = SalaryDefault::orderBy('section_code')->orderBy('sort_order')
            ->get()
            ->groupBy('section_code');

        return view('head_of_finance.salary.defaults', [
            'grouped'         => $grouped,
            'sectionIndex'    => $sectionIndex,
            'sectionAccounts' => $sectionAccounts,
        ]);
    }

    public function storeDefault(Request $request)
    {
        $request->validate([
            'section_coa'  => 'required|string|size:8',
            'account_code' => 'required|string|max:20',
            'item_name'    => 'required|string|max:255',
        ]);

        if (!ChartOfAccount::where('account_code', $request->section_coa)->whereHas('children')->exists()) {
            return back()->withErrors(['section_coa' => 'ໝວດທີ່ເລືອກບໍ່ຖືກຕ້ອງ']);
        }

        $sectionCode = $this->coaToSection($request->section_coa);

        // Convert 8-digit chart_of_accounts code → dot-notation; pass text input through as-is
        $rawCode     = $request->account_code;
        $accountCode = (strlen($rawCode) === 8 && ctype_digit($rawCode))
            ? $this->coaToAccount($rawCode)
            : $rawCode;

        $maxOrder = SalaryDefault::where('section_code', $sectionCode)->max('sort_order') ?? -1;

        SalaryDefault::create([
            'section_code' => $sectionCode,
            'account_code' => $accountCode,
            'sort_order'   => $maxOrder + 1,
            'item_name'    => $request->item_name,
        ]);

        return back()->with('success', 'ເພີ່ມ Default ສຳເລັດ!');
    }

    public function updateDefault(Request $request, SalaryDefault $default)
    {
        $request->validate([
            'account_code' => 'required|string|max:20',
            'item_name'    => 'required|string|max:255',
        ]);

        $default->update($request->only(['account_code', 'item_name']));

        return back()->with('success', 'ແກ້ໄຂ Default ສຳເລັດ!');
    }

    public function destroyDefault(SalaryDefault $default)
    {
        $default->delete();
        return back()->with('success', 'ລຶບ Default ສຳເລັດ!');
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function seedDefaults(SalaryPlan $plan): void
    {
        SalaryDefault::orderBy('section_code')->orderBy('sort_order')
            ->get()
            ->each(function ($d, $i) use ($plan) {
                SalaryPlanItem::create([
                    'plan_id'      => $plan->id,
                    'account_code' => $d->account_code,
                    'section_code' => $d->section_code,
                    'sort_order'   => $d->sort_order,
                    'item_name'    => $d->item_name,
                    'num_persons'  => 0,
                    'amount_atm'   => 0,
                    'amount_cash'  => 0,
                ]);
            });
    }

    // "60100000" → "60.10"  |  "61400000" → "61.40"
    private function coaToSection(string $code8): string
    {
        return substr($code8, 0, 2) . '.' . substr($code8, 2, 2);
    }

    // "60100100" → "60.10.01"
    private function coaToAccount(string $code8): string
    {
        return substr($code8, 0, 2) . '.' . substr($code8, 2, 2) . '.' . substr($code8, 4, 2);
    }

    private function buildSections($items): array
    {
        $sections = [];
        $totals   = [
            '60' => 0.0,
            '61' => 0.0,
            'grand_month' => 0.0,
            'grand_year'  => 0.0,
        ];

        foreach (array_keys($this->sectionMeta) as $sec) {
            $secItems   = $items->filter(fn($i) => $i->section_code === $sec)->values();
            $secTotal   = $secItems->sum(fn($i) => $i->totalPerMonth());
            $sections[$sec] = ['items' => $secItems, 'total_month' => $secTotal];

            $mainSec = substr($sec, 0, 2); // '60' or '61'
            $totals[$mainSec] += $secTotal;
        }

        $totals['grand_month'] = $totals['60'] + $totals['61'];
        $totals['grand_year']  = $totals['grand_month'] * 12;

        return [$sections, $totals];
    }
}
