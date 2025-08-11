<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectArea extends Model
{
    use HasFactory;

    public $table = "project_area";
    protected $fillable = [
        'project_id',
        'area_id',
        'is_archive',
        'is_archive_by',
        'is_archive_at',
        'created_at',
        'updated_at',
    ];

    public function Area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function Project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
