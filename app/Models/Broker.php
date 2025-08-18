<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as dbBuilder;

class Broker extends Model
{
    use HasFactory;

    protected $table = 'brokers';

    protected $guarded = [];

    protected $casts = [
        'deals_in' => 'array',
    ];

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'broker_area');
    }

    protected static function booted()
    {
        // align with other models: hide archived by default
        static::addGlobalScope(new HasIsNonArchiveScope);
        static::addGlobalScope('delete', function (dbBuilder $eloquentDbBuilder) {
            $eloquentDbBuilder->where('is_archive', 0);
        });
    }
}


