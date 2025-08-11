<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomActivityLog extends Model
{
    use HasFactory;

    public $table = 'activity_log';
    public $fillable = [
        'log_name',
        'description',
        'subject_type',
        'subject_id',
        'causer_type',
        'causer_id',
        'properties',
        'page_url',
        'duration_in_second',
        'ip',
        'created_at',
        'updated_at',
    ];
}
