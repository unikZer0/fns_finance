<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'plan_id', 'category_code', 'sort_order',
        'item_name', 'reference',
        'amount_per_month', 'num_months', 'notes',
    ];

    protected $casts = [
        'amount_per_month' => 'float',
        'num_months'       => 'float',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(ExpensePlan::class, 'plan_id');
    }

    public function totalPerYear(): float
    {
        return $this->amount_per_month * $this->num_months;
    }
}
