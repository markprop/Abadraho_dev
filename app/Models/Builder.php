<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as eloquentBuilder;


class Builder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = "builders";

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
        "is_active",
        "is_archive",
        "is_archive_by",
        "is_archive_at",
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
