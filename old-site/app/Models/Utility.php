<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as eloquentBuilder;

class Utility extends Model
{
    use HasFactory;

    public $table = "utilities";

    protected $fillable = [
        "id",
        "utility_name",
        "is_active",
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
        static::addGlobalScope('delete', function (eloquentBuilder $builder) {
            $builder->where('is_archive', 0);
        });
    }

    public function ProjectUtilities()
    {
        return $this->hasMany(ProjectUtilities::class, "utility_name");
    }
}
