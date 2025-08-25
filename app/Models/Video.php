<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'description',
        'project_id',
    ];

    /**
     * Get the project that owns the video.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}