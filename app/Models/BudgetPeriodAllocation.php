<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BudgetPeriodAllocation extends Model
{
    public $timestamps = false;

    protected $table = 'budget_period_allocations';

    protected $fillable = [
        'budget_line_item_id',
        'period_name',
        'allocated_amount',
    ];

    public function lineItem(): BelongsTo
    {
        return $this->belongsTo(BudgetLineItem::class, 'budget_line_item_id');
    }
}
