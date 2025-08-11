<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_type extends Model
{
    public $table = "user_types";
    
    protected $fillable = [
        "user_type_name",
        "isActive",
        "created_by",
        "updated_by",
    ];
}
