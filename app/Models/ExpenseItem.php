<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseItem extends Model
{
    protected $fillable = [
        'category_id', 'sort_order', 'name', 'reference',
        'monthly_amount', 'quantity', 'annual_amount', 'remark', 'chart_of_account_id',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::saving(function (self $item) {
            $item->annual_amount = (float) $item->monthly_amount * (int) $item->quantity;
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    public function chartOfAccount(): BelongsTo
    {
        return $this->belongsTo(ChartOfAccount::class, 'chart_of_account_id');
    }
}
