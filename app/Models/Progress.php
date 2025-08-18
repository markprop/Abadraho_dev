<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as dbBuilder;

class Progress extends Model
{
    use HasFactory;
    
    public $table = "progress_status";

    protected $fillable = [
        "id",
        "progress_status_name",
        "isActive",
        "is_archive",
        "is_archive_by",
        "is_archive_at",
        "created_by",
        "updated_by",
        "created_at",
        "updated_at",
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

    // public function progress()
    // {
    //     return $this->belongsTo(Progress::class, 'progress_id');
    // }

    public function project()
    {
        return $this->hasMany(Project::class, 'progress_status_id', 'id');
    }
}
