<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpenseDefault extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'parent_id', 'category_code', 'sort_order',
        'item_name', 'reference',
        'amount_per_month', 'num_months', 'notes',
    ];

    protected $casts = [
        'amount_per_month' => 'float',
        'num_months'       => 'float',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ExpenseDefault::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ExpenseDefault::class, 'parent_id')->orderBy('sort_order');
    }
}
