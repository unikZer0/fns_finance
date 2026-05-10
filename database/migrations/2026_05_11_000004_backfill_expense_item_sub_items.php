<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\ExpenseDefault;
use App\Models\ExpenseItem;
use App\Models\ExpensePlan;

return new class extends Migration
{
    public function up(): void
    {
        // Build a map of reference → default children
        $defaultMap = ExpenseDefault::whereNull('parent_id')
            ->with('children')
            ->get()
            ->keyBy('reference');

        foreach (ExpensePlan::all() as $plan) {
            $parentItems = ExpenseItem::where('plan_id', $plan->id)
                ->whereNull('parent_id')
                ->get();

            foreach ($parentItems as $parentItem) {
                // Skip if already has children
                if (ExpenseItem::where('parent_id', $parentItem->id)->exists()) {
                    continue;
                }

                $default = $defaultMap[$parentItem->reference] ?? null;
                if (!$default || $default->children->isEmpty()) {
                    continue;
                }

                foreach ($default->children as $i => $child) {
                    ExpenseItem::create([
                        'plan_id'          => $plan->id,
                        'parent_id'        => $parentItem->id,
                        'category_code'    => $parentItem->category_code,
                        'sort_order'       => $i,
                        'item_name'        => $child->item_name,
                        'reference'        => $child->reference,
                        'amount_per_month' => $child->amount_per_month,
                        'num_months'       => $child->num_months,
                        'notes'            => $child->notes,
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        ExpenseItem::whereNotNull('parent_id')->delete();
    }
};
