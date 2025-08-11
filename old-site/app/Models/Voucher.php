<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    public $table = "vouchers";

    protected $fillable = [
        'model_id',
        'model_type',
        'project_id',
        'name',
        'discount_by',
        'discount_applied',
        'discount_value',
        'code',
        'data',
        'status',
        'expires_at'
    ];


    public function project() {
        return $this->hasOne(Project::class,'id','project_id');
    }

    public function units_voucher() {
        return $this->hasMany(UnitsVoucher::class,'voucher_id','id');
    }

    public function user_voucher() {
        return $this->hasMany(UserVoucher::class,'voucher_id','id');
    }
}
