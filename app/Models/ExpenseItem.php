<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ChartOfAccount;

class ExpenseItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'plan_id', 'parent_id', 'category_code', 'sort_order',
        'item_name', 'reference',
        'amount_per_month', 'num_months', 'notes',
        'chart_of_account_id',
    ];

    protected $casts = [
        'amount_per_month' => 'float',
        'num_months'       => 'float',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(ExpensePlan::class, 'plan_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ExpenseItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ExpenseItem::class, 'parent_id')->orderBy('sort_order');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccount::class, 'chart_of_account_id');
    }

    public function totalPerYear(): float
    {
        return $this->amount_per_month * $this->num_months;
    }
}
