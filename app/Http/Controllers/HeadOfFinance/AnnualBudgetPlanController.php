<?php

namespace App\Http\Controllers\HeadOfFinance;

use App\Http\Controllers\Controller;
use App\Models\BudgetLineItem;
use App\Models\BudgetPlan;
use App\Models\ChartOfAccount;
use Illuminate\Http\Request;

class AnnualBudgetPlanController extends Controller
{
    // ─── Plans CRUD ───────────────────────────────────────────────────────

    public function index()
    {
        $plans = BudgetPlan::orderByDesc('fiscal_year')->get();
        return view('head_of_finance.annual-budget.index', compact('plans'));
    }

    public function create()
    {
        return view('head_of_finance.annual-budget.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fiscal_year' => 'required|integer|min:2000|max:2100|unique:budget_plans,fiscal_year',
        ]);

        BudgetPlan::create([
            'fiscal_year' => $request->fiscal_year,
            'status' => 'draft',
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('head_of_finance.annual-budget.index')
            ->with('success', 'ສ້າງແຜນງົບປະມານສຳເລັດ!');
    }

    public function show(BudgetPlan $annualBudget)
    {
        $accounts = ChartOfAccount::orderBy('account_code')->get();
        $annualBudget->load(['lineItems.account', 'lineItems.periodAllocations']);
        $annualBudget->setRelation('lineItems', $this->sortLineItemsHierarchically($annualBudget->lineItems));
        return view('head_of_finance.annual-budget.show', compact('annualBudget', 'accounts'));
    }

    public function preview(BudgetPlan $annualBudget)
    {
        $annualBudget->load(['lineItems.account']);
        $annualBudget->setRelation('lineItems', $this->sortLineItemsHierarchically($annualBudget->lineItems));
        return view('head_of_finance.annual-budget.preview', compact('annualBudget'));
    }

    public function exportPdf(BudgetPlan $annualBudget)
    {
        $annualBudget->load(['lineItems.account', 'lineItems.periodAllocations']);
        $annualBudget->setRelation('lineItems', $this->sortLineItemsHierarchically($annualBudget->lineItems));

        $html = view('head_of_finance.annual-budget.pdf', compact('annualBudget'))->render();

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'fontDir' => array_merge($fontDirs, [
                storage_path('fonts'),
            ]),
            'fontdata' => $fontData + [
                'notosanslao' => [
                    'R' => 'NotoSansLao-Regular.ttf',
                    'B' => 'NotoSansLao-Bold.ttf',
                ],
            ],
            'default_font' => 'notosanslao',
        ]);

        // Fix mPDF complex script issues for Lao
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $mpdf->WriteHTML($html);
        return response($mpdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="ແຜນງົບປະມານປະຈຳປີ_' . $annualBudget->fiscal_year . '.pdf"');
    }

    public function edit(BudgetPlan $annualBudget)
    {
        $accounts = ChartOfAccount::orderBy('account_code')->get();
        $annualBudget->load(['lineItems.account']);
        return view('head_of_finance.annual-budget.edit', compact('annualBudget', 'accounts'));
    }

    public function update(Request $request, BudgetPlan $annualBudget)
    {
        $request->validate([
            'fiscal_year' => 'required|integer|min:2000|max:2100|unique:budget_plans,fiscal_year,' . $annualBudget->id,
            'status' => 'required|in:draft,submitted,approved',
        ]);

        $annualBudget->update($request->only('fiscal_year', 'status'));

        return redirect()->route('head_of_finance.annual-budget.show', $annualBudget)
            ->with('success', 'ອັບເດດແຜນງົບປະມານສຳເລັດ!');
    }

    public function destroy(BudgetPlan $annualBudget)
    {
        $annualBudget->lineItems()->each(function ($item) {
            $item->periodAllocations()->delete();
        });
        $annualBudget->lineItems()->delete();
        $annualBudget->delete();

        return redirect()->route('head_of_finance.annual-budget.index')
            ->with('success', 'ລຶບແຜນງົບປະມານສຳເລັດ!');
    }

    // ─── Line Item CRUD ───────────────────────────────────────────────────

    public function storeItem(Request $request, BudgetPlan $annualBudget)
    {
        $request->validate([
            'account_id' => 'required|exists:chart_of_accounts,id',
            'amount_regular' => 'nullable|numeric|min:0',
            'amount_academic' => 'nullable|numeric|min:0',
        ]);

        // Prevent duplicate account in same plan
        $exists = $annualBudget->lineItems()->where('account_id', $request->account_id)->exists();
        if ($exists) {
            return back()->with('error', 'ບັນຊີນີ້ມີຢູ່ໃນແຜນແລ້ວ!');
        }

        $annualBudget->lineItems()->create([
            'account_id' => $request->account_id,
            'amount_regular' => $request->amount_regular ?? 0,
            'amount_academic' => $request->amount_academic ?? 0,
        ]);

        return back()->with('success', 'ເພີ່ມລາຍການງົບປະມານສຳເລັດ!');
    }

    public function storeBulkItems(Request $request, BudgetPlan $annualBudget)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.account_id' => 'nullable|exists:chart_of_accounts,id',
            'items.*.amount_regular' => 'nullable|numeric|min:0',
            'items.*.amount_academic' => 'nullable|numeric|min:0',
        ]);

        $skipped = 0;
        $added = 0;

        foreach ($request->items as $row) {
            if (empty($row['account_id']))
                continue;

            $exists = $annualBudget->lineItems()
                ->where('account_id', $row['account_id'])
                ->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            $annualBudget->lineItems()->create([
                'account_id' => $row['account_id'],
                'amount_regular' => $row['amount_regular'] ?? 0,
                'amount_academic' => $row['amount_academic'] ?? 0,
            ]);
            $added++;
        }

        $msg = "ເພີ່ມ {$added} ລາຍການສຳເລັດ!";
        if ($skipped > 0)
            $msg .= " (ຂ້າມ {$skipped} ລາຍການທີ່ຊ້ຳ)";

        return back()->with('success', $msg);
    }

    public function updateItem(Request $request, BudgetPlan $annualBudget, BudgetLineItem $item)
    {
        $request->validate([
            'amount_regular' => 'nullable|numeric|min:0',
            'amount_academic' => 'nullable|numeric|min:0',
        ]);

        $item->update([
            'amount_regular' => $request->amount_regular ?? 0,
            'amount_academic' => $request->amount_academic ?? 0,
        ]);

        return back()->with('success', 'ອັບເດດລາຍການສຳເລັດ!');
    }

    public function destroyItem(BudgetPlan $annualBudget, BudgetLineItem $item)
    {
        $item->periodAllocations()->delete();
        $item->delete();

        return back()->with('success', 'ລຶບລາຍການສຳເລັດ!');
    }

    /**
     * Sort line items hierarchically based on the account structure.
     */
    protected function sortLineItemsHierarchically($lineItems)
    {
        return $lineItems->sortBy('account.account_code')->values();
    }
}
