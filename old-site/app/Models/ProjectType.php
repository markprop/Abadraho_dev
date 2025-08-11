<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as dbBuilder;

class ProjectType extends Model
{
    use HasFactory;

    protected $table = 'project_type';

    protected $fillable = [
        'title', 
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
            $eloquentDbBuilder->where('is_archive', 0);
        });
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
