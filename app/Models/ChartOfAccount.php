<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    /** @use HasFactory<\Database\Factories\ChartOfAccountFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $table = 'chart_of_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'account_code',
        'account_name',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(ChartOfAccount::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ChartOfAccount::class, 'parent_id');
    }

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
        ];
    }

    /**
     * Get the code formatted with dashes (e.g. 60-00-00-00)
     */
    public function getFormattedCodeAttribute(): string
    {
        $code = $this->account_code;
        if (strlen($code) === 8) {
            return substr($code, 0, 2) . '-' . substr($code, 2, 2) . '-' . substr($code, 4, 2) . '-' . substr($code, 6, 2);
        }
        return $code;
    }
}
