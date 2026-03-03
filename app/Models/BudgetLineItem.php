<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BudgetLineItem extends Model
{
    public $timestamps = false;

    protected $table = 'budget_line_items';

    protected $fillable = [
        'budget_plan_id',
        'account_id',
        'amount_regular',
        'amount_academic',
    ];

    /**
     * The budget plan this item belongs to.
     */
    public function budgetPlan(): BelongsTo
    {
        return $this->belongsTo(BudgetPlan::class, 'budget_plan_id');
    }

    /**
     * The chart of account linked to this item.
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccount::class, 'account_id');
    }

    /**
     * Period allocations for this line item.
     */
    public function periodAllocations(): HasMany
    {
        return $this->hasMany(BudgetPeriodAllocation::class, 'budget_line_item_id');
    }
}
