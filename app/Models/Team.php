<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'team_lead_id',
        'description',
    ];

    public function getRoutKeyName()
    {
        return 'slug';
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'team_users')->withPivot('status')->withTimestamps();
    }

    public function leader()
    {
        return $this->belongsTo(Builder::class, 'builders');
    }

    public function builders()
    {
        return $this->belongsToMany(Builder::class, 'team_builders')->withPivot('status')->withTimestamps();
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'team_projects');
    }
}
