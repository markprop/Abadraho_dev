<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'rooms',
        'covered_area',
        'measurement_type',
        'price',
        'loan_amount',
        'total_unit_amount',
        'project_id',
        'monthly_installment',
        'installment_type',
        'installment_length',
        'down_payment',
        'possession',
        'description',
        'payment_plan_img',
        'floor_plan_img',
        'unit_type_id',
        'installment',
        'is_archive',
        'is_archive_by',
        'is_archive_at',
    ];

    protected static function booted()
    {
        // using seperate scope class
        static::addGlobalScope(new HasIsNonArchiveScope);

        // you can do the same thing using anonymous function
        // let's add another scope using anonymous function
        static::addGlobalScope('delete', function (Builder $builder) {
            $builder->where('is_archive', 0);
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'id');
    }
    public function UnitRooms()
    {
        return $this->hasMany(UnitRoom::class, 'unit_id');
    }
    public function room()
    {
        return $this->belongsToMany(RoomType::class)->withPivot('id', 'width', 'length', 'extras', 'covered_area')->withTimestamps()->orderBy('name');
    }
    public function unit_rooms()
    {
        return $this->belongsToMany(RoomType::class);
    }
    public function measurement()
    {
        return $this->belongsTo(Measurement::class, 'measurement_type');
    }
    public function type()
    {
        return $this->belongsTo(ProjectType::class, 'unit_type_id');
    }
    public function installments()
    {
        return $this->belongsTo(InstallmentType::class, 'installment_type');
    }
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
    public function payment_schedules()
    {
        return $this->hasMany(PaymentSchedule::class);
    }
    public function UnitVoucher() {
        return $this->hasOne(UnitsVoucher::class,'unit_id');
    }
}