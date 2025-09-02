<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as dbBuilder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\HasIsNonArchiveScope;
use BeyondCode\Vouchers\Traits\HasVouchers;

class Project extends Model
{
    use HasFactory;
    // use SoftDeletes;
    use HasVouchers;

    protected $fillable = [
        'name',
        'address',
        'area',
        'discount_price',
        'latitude',
        'longitude',
        'project_type_id',
        'progress_status_id',
        'progress',
        'project_doc',
        'details',
        'slug',
        'rooms',
        'installment_length',
        'status',
        'added_time',
        'property_id',
        'meta_title',
        'meta_description',
        'meta_tags',
        'marketed_by',
        'is_archive',
        'is_archive_by',
        'is_archive_at',
        'views',
        'created_by', // Added to allow mass assignment of the logged-in user's name
    ];

    protected static function booted()
    {
        // using separate scope class
        static::addGlobalScope(new HasIsNonArchiveScope);

        // you can do the same thing using anonymous function
        // let's add another scope using anonymous function
        static::addGlobalScope('delete', function (dbBuilder $builder) {
            $builder->where('is_archive', 0);
        });
    }

    public function getRoutKeyName()
    {
        return 'slug';
    }

    public function subcategory()
    {
        return $this->belongsTo(Progress::class, 'progress_status_id', 'id');
    }

    public function progress()
    {
        return $this->belongsTo(Progress::class, 'progress_status_id', 'id');
    }

    public function owners()
    {
        return $this->belongsToMany(Builder::class, 'project_owners')->withTimestamps();
    }
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
    public function type()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_projects');
    }
    public function users()
    {
        return $this->belongsToMany(Admin::class, 'project_users')->withTimestamps();
    }
    public function location()
    {
        return $this->belongsTo(Area::class, 'area');
    }
    public function project_info()
    {
        return $this->hasOne(ProjectInfo::class);
    }
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
    public function recent_views()
    {
        return $this->hasMany(RecentViews::class);
    }
    public function payment_schedules()
    {
        return $this->hasMany(PaymentSchedule::class);
    }
    public function areas()
    {
        return $this->hasMany(ProjectArea::class);
    }
    public function ProjectArea()
    {
        return $this->belongsToMany(Area::class, 'project_area');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tag');
    }
    public function project_rooms()
    {
        return $this->hasMany(UnitRoom::class, "project_id");
    }
    public function project_unit_rooms()
    {
        return $this->belongsToMany(RoomType::class, 'room_type_unit')
            ->withPivot('id', 'width', 'length', 'extras', 'covered_area')
            ->withTimestamps()->orderBy('id');
    }
    public function ProjectUtils()
    {
        return $this->hasMany(ProjectUtilities::class, "project_id");
    }
    public function ProjectAmenities()
    {
        return $this->hasMany(ProjectAmenities::class, "project_id");
    }
    public function ProjectVoucher()
    {
        return $this->hasOne(Voucher::class, "project_id")->where('discount_applied','=', 'project');
    }
}