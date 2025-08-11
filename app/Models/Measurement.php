<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'symbol',
        'convertor'
    ];

    public function unit()
    {
        return $this->hasMany(Unit::class);
    }
}
