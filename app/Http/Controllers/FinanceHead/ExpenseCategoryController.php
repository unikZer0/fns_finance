<?php

namespace App\Http\Controllers\FinanceHead;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Models\ExpensePlan;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'plan_id'    => 'required|exists:expense_plans,id',
            'parent_id'  => 'nullable|exists:expense_categories,id',
            'ref_code'   => 'required|string|max:20',
            'name'       => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $plan = ExpensePlan::findOrFail($data['plan_id']);
        if ($plan->isApproved()) {
            return back()->with('error', 'ບໍ່ສາມາດແກ້ໄຂແຜນທີ່ອະນຸມັດແລ້ວ');
        }

        ExpenseCategory::create([
            'plan_id'    => $data['plan_id'],
            'parent_id'  => $data['parent_id'] ?? null,
            'ref_code'   => $data['ref_code'],
            'name'       => $data['name'],
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()->route('head_of_finance.expense.manage', $plan)
            ->with('success', 'ເພີ່ມໝວດສຳເລັດ');
    }

    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        if ($expenseCategory->plan->isApproved()) {
            return back()->with('error', 'ບໍ່ສາມາດແກ້ໄຂແຜນທີ່ອະນຸມັດແລ້ວ');
        }

        $data = $request->validate([
            'ref_code'   => 'required|string|max:20',
            'name'       => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $expenseCategory->update($data);

        return back()->with('success', 'ອັບເດດໝວດສຳເລັດ');
    }

    public function destroy(ExpenseCategory $expenseCategory)
    {
        if ($expenseCategory->plan->isApproved()) {
            return back()->with('error', 'ບໍ່ສາມາດແກ້ໄຂແຜນທີ່ອະນຸມັດແລ້ວ');
        }

        $plan = $expenseCategory->plan;
        $this->deleteRecursive($expenseCategory);

        return redirect()->route('head_of_finance.expense.manage', $plan)
            ->with('success', 'ລຶບໝວດສຳເລັດ');
    }

    private function deleteRecursive(ExpenseCategory $category): void
    {
        foreach ($category->children()->get() as $child) {
            $this->deleteRecursive($child);
        }
        $category->items()->delete();
        $category->delete();
    }
}
