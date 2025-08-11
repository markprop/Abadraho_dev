<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as dbBuilder;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        "is_archive",
        "is_archive_by",
        "is_archive_at",
    ];

    protected static function booted()
    {
        // using seperate scope class
        static::addGlobalScope(new HasIsNonArchiveScope);

        // you can do the same thing using anonymous function
        // let's add another scope using anonymous function
        static::addGlobalScope('delete', function (dbBuilder $eloquentDbBuilder) {
            $eloquentDbBuilder->where('areas.is_archive', 0);
        });
    }

    // public function projects()
    // {
    //     return $this->hasMany(Project::class);
    // }
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_area');
    }
}
