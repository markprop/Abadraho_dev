<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSearchHistory extends Model
{
    use HasFactory;
    protected $table = 'user_search_history';
    protected $fillable = [
        'user_id',
        'hash',
        'search_type',
        'json',
        'minDP',
        'maxDP',
        'minMI',
        'maxMI',
        'minPrice',
        'maxPrice',
        'downPayment',
        'maxBudget',
        'created_at',
        'updated_at',
        'slabCasting',
        'plinth',
        'colour',
        'monthInstall',
        'yearlyInstall',
        'halfYearlyInstall',
        'quarterlyInstall',
        'possession',
        'cookie'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
