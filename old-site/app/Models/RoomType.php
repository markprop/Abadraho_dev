<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as dbBuilder;

class RoomType extends Model
{
    use HasFactory;
    public $table = "room_types";
    protected $fillable = [
        'name',
        'icon',
        'to_show',
        'sort_order',
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
//        static::addGlobalScope('delete', function (dbBuilder $eloquentDbBuilder) {
//            $eloquentDbBuilder->where('is_archive', 0);
//        });
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'room_type_unit');
    }

    public function UnitRoom()
    {
        return $this->hasMany(RoomType::class, 'room_type_id');
    }
}
