<?php

namespace App\Http\Controllers\HeadOfFinance;

use App\Http\Controllers\Controller;
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

    private array $defaults = [
        ['code' => '60.10.01', 'sec' => '60.10', 'name' => 'ເງິນເດືອນ ພ/ງ ພວມປະຕິບັດງານ 100%'],
        ['code' => '60.10.02', 'sec' => '60.10', 'name' => 'ເງິນເດືອນເພື່ອເລື່ອນຊັ້ນ'],
        ['code' => '60.10.03', 'sec' => '60.10', 'name' => 'ເງິນເດືອນ ພ/ງ ເຂົ້າໃໝ່ 95%'],
        ['code' => '60.10.04', 'sec' => '60.10', 'name' => 'ເງິນເດືອນ ພ/ງ ຮຽນຕໍ່ພາຍໃນ'],
        ['code' => '60.10.05', 'sec' => '60.10', 'name' => 'ເງິນເດືອນ ພ/ງ ຮຽນຕໍ່ຕ່າງປະເທດ'],
        ['code' => '60.10.06', 'sec' => '60.10', 'name' => 'ເງິນເດືອນ ພ/ງ ຕາມສັນຍາ'],
        ['code' => '60.20.01', 'sec' => '60.20', 'name' => 'ອຸດໜູນຕໍາແໜ່ງ'],
        ['code' => '60.20.02', 'sec' => '60.20', 'name' => 'ອຸດໜູນອາຊີບ'],
        ['code' => '60.20.03', 'sec' => '60.20', 'name' => 'ອຸດໜູນອາຍຸການ'],
        ['code' => '60.20.04', 'sec' => '60.20', 'name' => 'ອຸດໜູນວຽກໜັກ-ທາງເບື່ອ'],
        ['code' => '60.20.05', 'sec' => '60.20', 'name' => 'ອຸດໜູນສອນຫ້ອງຄວບ'],
        ['code' => '60.20.06', 'sec' => '60.20', 'name' => 'ອຸດໜູນຄ່າຄອງຊີບ'],
        ['code' => '61.20.01', 'sec' => '61.20', 'name' => 'ອຸດໜູນລູກພະນັກງານ'],
        ['code' => '61.20.02', 'sec' => '61.20', 'name' => 'ອຸດໜູນເມຍພະນັກງານ'],
        ['code' => '61.30.01', 'sec' => '61.30', 'name' => 'ກ່ອນອອກການ'],
        ['code' => '61.30.02', 'sec' => '61.30', 'name' => 'ກ່ອນອອກບໍານານ'],
        ['code' => '61.40.01', 'sec' => '61.40', 'name' => 'ເຮັດວຽກນອກໂມງລັດຖະການ'],
        ['code' => '61.40.02', 'sec' => '61.40', 'name' => 'ແປພາສາ'],
        ['code' => '61.40.03', 'sec' => '61.40', 'name' => 'ຄົ້ນຄວ້າ ແລະ ວິໄຈ'],
        ['code' => '61.40.04', 'sec' => '61.40', 'name' => 'ຂຽນບົດ ແລະ ຮຽບຮຽງ'],
        ['code' => '61.40.05', 'sec' => '61.40', 'name' => 'ສອນພິເສດ'],
        ['code' => '61.40.06', 'sec' => '61.40', 'name' => 'ຄ່າເວັນຍາມ (ປ້ອງກັນ)'],
        ['code' => '61.50.01', 'sec' => '61.50', 'name' => 'ເບ້ຍລ້ຽງນັກຮຽນ ປ.ຕີ (ພາຍໃນ)'],
        ['code' => '61.50.02', 'sec' => '61.50', 'name' => 'ຄ່າອັດຕາກິນ-ຝຶກງານ'],
        ['code' => '61.50.03', 'sec' => '61.50', 'name' => 'ຄ່າເດີນທາງ-ຝຶກງານ'],
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

    // ─── Helpers ──────────────────────────────────────────────────────────────

    private function seedDefaults(SalaryPlan $plan): void
    {
        foreach ($this->defaults as $i => $d) {
            SalaryPlanItem::create([
                'plan_id'      => $plan->id,
                'account_code' => $d['code'],
                'section_code' => $d['sec'],
                'sort_order'   => $i,
                'item_name'    => $d['name'],
                'num_persons'  => 0,
                'amount_atm'   => 0,
                'amount_cash'  => 0,
            ]);
        }
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
