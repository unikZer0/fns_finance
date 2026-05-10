<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryDefault extends Model
{
    public $timestamps = false;

    protected $fillable = ['account_code', 'section_code', 'sort_order', 'item_name'];
}
