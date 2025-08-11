<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Builder extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'user_id',
        'username',
        'email',
        'password',
        'record_id',
        'phone_number',
        'remember_token',
        'contact_person_name',
        'contact_person_email',
        'contact_person_phone_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_owners');
    }
    
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_builders')->withTimestamps();
    }

    public function teamsLeader()
    {
        return $this->hasMany(Team::class, 'teams');
    }
}
