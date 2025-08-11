<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZohoForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone_number',
        'unit_id'
    ];
}
