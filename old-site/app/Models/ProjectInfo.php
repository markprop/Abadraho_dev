<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectInfo extends Model
{
    use HasFactory;
    protected $table = 'project_infos';
    protected $fillable = [
        'project_id',
        'main_heading',
        'sub_heading',
        'bullet_1',
        'bullet_2',
        'bullet_3',
        'bullet_4',
        'bullet_5',
        'bullet_6',
    ];

    public function projects()
    {
        return $this->belongsTo(Project::class());
    }
}
