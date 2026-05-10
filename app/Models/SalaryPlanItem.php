<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryPlanItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'plan_id', 'account_code', 'section_code', 'sort_order',
        'item_name', 'num_persons', 'amount_atm', 'amount_cash', 'notes',
    ];

    protected $casts = [
        'amount_atm'  => 'float',
        'amount_cash' => 'float',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(SalaryPlan::class, 'plan_id');
    }

    public function totalPerMonth(): float
    {
        return $this->amount_atm + $this->amount_cash;
    }

    public function totalPerYear(): float
    {
        return $this->totalPerMonth() * 12;
    }
}
