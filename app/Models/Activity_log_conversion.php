<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity_log_conversion extends Model
{
    use HasFactory;

    public $table = "activity_log_conversions";
    protected $fillable = [
        'conversion',
        'description',
    ];

    // public function projects()
    // {
    //     return $this->hasMany(Project::class);
    // }

    // public function projects()
    // {
    //     return $this->belongsToMany(Project::class, 'project_area');
    // }
}
