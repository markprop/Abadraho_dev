<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as eloquentBuilder;

class UnitRoom extends Model
{
    use HasFactory;

    public $table = "room_type_unit";

    protected $fillable = [
        'room_type_id',
        'unit_id',
        'project_id',
        'width',
        'width_feet',
        'width_inches',
        'length',
        'length_feet',
        'length_inches',
        'covered_area',
        'extras',
        'is_display_on_listing',
        'is_archive',
        'is_archive_by',
        'is_archive_at',
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

    public function units()
    {
        return $this->belongsToMany(Unit::class, "unit_id");
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_id');
    }

    public function RoomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function Rooms()
    {
        return $this->hasMany(UnitRoom::class, 'room_type_id');
    }
}
