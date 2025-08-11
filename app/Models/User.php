<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use RecentlyViewed\Models\Contracts\Viewer;
use RecentlyViewed\Models\Traits\CanView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use BeyondCode\Vouchers\Traits\CanRedeemVouchers;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as dbBuilder;

// Activity Log
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, LogsActivity; //LogsActivity
    use CanRedeemVouchers;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'user_type_id',
        'email',
        'about_me',
        'Address',
        'city',
        'password',
        'image',
        'record_id',
        'remember_token',
        'record_id',
        'provider',
        'phone_number',
        'avatar',
        'phone_no_otp',
        'is_phone_no_verified',
        "is_archive",
        "is_archive_by",
        "is_archive_at",
    ];

    protected static function booted()
    {
        // using seperate scope class
        static::addGlobalScope(new HasIsNonArchiveScope);

        // you can do the same thing using anonymous function
        // let's add another scope using anonymous function
        static::addGlobalScope('delete', function (dbBuilder $eloquentDbBuilder) {
            $eloquentDbBuilder->where('is_archive', 0);
        });
    }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    // Start Activity Log Work
    protected static $logAttributes = [
        'first_name',
        'last_name',
        'username',
        'user_type_id',
        'email',
        'about_me',
        'Address',
        'city',
        'password',
        'image',
        'record_id',
        'remember_token',
        'record_id',
        'provider',
        'phone_number',
        'avatar',
        'phone_no_otp',
        'is_phone_no_verified',
    ];
    // // protected static $logName = 'User';
    // // protected static $logFillable = true;
    // // protected static $submitEmptyLogs = false;
    protected static $recordEvents = ['created', 'updated', 'deleted'];

    // protected static $logOnlyDirty = true;
    /** The following change of attributes will be logged. */
    //protected static $logAttributes = ['name', 'text'];

    /** Alternativly we can define that following attribute changes should be not recoreded */
    //protected static $ignoreChangedAttributes = ['text'];

    /** Only the `deleted` event will get logged automatically */
    //protected static $recordEvents = ['deleted'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "A user has been {$eventName}";
    }

    // End Activity Log Work



    public function Builder()
    {
        return $this->hasOne('App\Models\Builder', 'user_id');
    }

    public function isBuilderLoggedIn()
    {
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Builder")) {
            return true;
        } else {
            return false;
        }
    }

    public function GetBuilderId()
    {
        if ($this->isBuilderLoggedIn()) {
            $Builder = Builder::where("userId", Auth::user()->id)->first();
            return $Builder->id;
        } else {
            return 0;
        }
    }

    public function isWebsiteUserLoggedIn()
    {
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.WebSiteUser")) {
            return true;
        } else {
            return false;
        }
    }

    public function isSuperAdminLoggedIn()
    {
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.SuperAdmin")) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdminLoggedIn()
    {
        if (Auth::user()->user_type_id == Config::get("constants.UserTypeIds.Admin")) {
            return true;
        } else {
            return false;
        }
    }

    public function User_type()
    {
        return $this->belongsTo('App\Models\User_type', 'user_type_id');
    }



    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_users');
    }
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
    //    public function projects()
    //    {
    //        return $this->belongsToMany(Project::class, 'project_users')->withTimestamps();
    //    }
    public function user_search_historys()
    {
        return $this->hasMany(UserSearchHistory::class);
    }
    public function payment_schedules()
    {
        return $this->hasMany(PaymentSchedule::class);
    }
}
