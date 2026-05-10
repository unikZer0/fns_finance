<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseDefault extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'category_code', 'sort_order',
        'item_name', 'reference',
        'amount_per_month', 'num_months', 'notes',
    ];
}
