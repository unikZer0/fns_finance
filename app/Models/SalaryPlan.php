<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalaryPlan extends Model
{
    protected $fillable = ['fiscal_year', 'status', 'created_by'];

    public function items(): HasMany
    {
        return $this->hasMany(SalaryPlanItem::class, 'plan_id')->orderBy('sort_order');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
