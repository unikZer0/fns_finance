<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'department_name',
        'department_type',
    ];

    /**
     * Get the users for the department.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
