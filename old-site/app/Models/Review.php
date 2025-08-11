<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = [
        'project_id',
        'user_id',
        'rating',
        'review',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
