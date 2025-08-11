<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{
    public $table = "user_voucher";
    
    protected $fillable = [
        "user_id",
        "code",
        "voucher_id",
        "redeemed_at",
    ];

    public function voucher() {
        return $this->hasOne(Voucher::class,'id','voucher_id');
    }

    public function user() {
        return $this->hasOne(User::class,'id','user_id');
    }

}