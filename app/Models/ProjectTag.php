<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTag extends Model
{
    use HasFactory;

    public $table = "project_tag";
    protected $fillable = [
        'project_id',
        'tag_id',
        'is_archive',
        'is_archive_by',
        'is_archive_at',
        'created_at',
        'updated_at',
    ];
}
