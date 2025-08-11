<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUsers extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'admin_id',
        'status'
    ];

}
