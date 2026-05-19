<?php

namespace App\Http\Controllers\FinanceHead;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Models\ExpenseItem;
use Illuminate\Http\Request;

class ExpenseItemController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'         => 'required|exists:expense_categories,id',
            'name'                => 'required|string|max:255',
            'reference'           => 'nullable|string|max:100',
            'monthly_amount'      => 'required|numeric|min:0',
            'quantity'            => 'required|integer|min:1',
            'qty_c'               => 'nullable|numeric|min:0',
            'remark'              => 'nullable|string|max:255',
            'chart_of_account_id' => 'nullable|exists:chart_of_accounts,id',
            'sort_order'          => 'nullable|integer|min:0',
        ]);

        $category = ExpenseCategory::findOrFail($data['category_id']);
        if ($category->plan->isApproved()) {
            return back()->with('error', 'ບໍ່ສາມາດແກ້ໄຂແຜນທີ່ອະນຸມັດແລ້ວ');
        }

        ExpenseItem::create($data);

        return redirect()->route('head_of_finance.expense.manage', $category->plan)
            ->with('success', 'ເພີ່ມລາຍການສຳເລັດ');
    }

    public function update(Request $request, ExpenseItem $expenseItem)
    {
        if ($expenseItem->category->plan->isApproved()) {
            return back()->with('error', 'ບໍ່ສາມາດແກ້ໄຂແຜນທີ່ອະນຸມັດແລ້ວ');
        }

        $data = $request->validate([
            'name'                => 'required|string|max:255',
            'reference'           => 'nullable|string|max:100',
            'monthly_amount'      => 'required|numeric|min:0',
            'quantity'            => 'required|integer|min:1',
            'qty_c'               => 'nullable|numeric|min:0',
            'remark'              => 'nullable|string|max:255',
            'chart_of_account_id' => 'nullable|exists:chart_of_accounts,id',
            'sort_order'          => 'nullable|integer|min:0',
        ]);

        $expenseItem->update($data);

        return back()->with('success', 'ອັບເດດລາຍການສຳເລັດ');
    }

    public function destroy(ExpenseItem $expenseItem)
    {
        if ($expenseItem->category->plan->isApproved()) {
            return back()->with('error', 'ບໍ່ສາມາດແກ້ໄຂແຜນທີ່ອະນຸມັດແລ້ວ');
        }

        $plan = $expenseItem->category->plan;
        $expenseItem->delete();

        return redirect()->route('head_of_finance.expense.manage', $plan)
            ->with('success', 'ລຶບລາຍການສຳເລັດ');
    }
}
