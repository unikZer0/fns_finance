<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicIncomeDefault extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'section_code',
        'sort_order',
        'item_name',
        'num_credits',
        'rate_per_person',
        'nuol_percentage',
        'student_year',
    ];

    protected $casts = [
        'rate_per_person' => 'float',
        'nuol_percentage' => 'float',
    ];
}
