<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicIncomePlan extends Model
{
    protected $fillable = [
        'fiscal_year', 'status',
        'nuol_pct_1_1', 'nuol_pct_1_2', 'nuol_pct_1_3', 'nuol_pct_1_4',
        'notes', 'created_by',
    ];

    protected $casts = [
        'nuol_pct_1_1' => 'decimal:4',
        'nuol_pct_1_2' => 'decimal:4',
        'nuol_pct_1_3' => 'decimal:4',
        'nuol_pct_1_4' => 'decimal:4',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(AcademicIncomeItem::class, 'plan_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isApproved(): bool
    {
        return $this->status === 'APPROVED';
    }
}
