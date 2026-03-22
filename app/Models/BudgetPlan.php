<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BudgetPlan extends Model
{
    public $timestamps = false;

    protected $table = 'budget_plans';

    protected $fillable = [
        'fiscal_year',
        'status',
        'created_by',
    ];

    /**
     * Get the line items for this budget plan.
     */
    public function lineItems(): HasMany
    {
        return $this->hasMany(BudgetLineItem::class, 'budget_plan_id');
    }
}
