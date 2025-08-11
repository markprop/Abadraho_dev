<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitsVoucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'unit_id'
    ];


    public function unit() {
        return $this->hasOne(Unit:: class,'id','unit_id');
    }

}
