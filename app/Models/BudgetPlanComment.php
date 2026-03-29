<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetPlanComment extends Model
{
    protected $fillable = ['budget_plan_id', 'user_id', 'comment', 'submission_round', 'marked_at', 'marked_by'];

    protected $casts = [
        'marked_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markedBy()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }

    public function budgetPlan()
    {
        return $this->belongsTo(BudgetPlan::class);
    }

    public function isMarked(): bool
    {
        return !is_null($this->marked_at);
    }
}
