<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    protected $table = "inquiries";
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'phone_number',
        'unit_id',
        'project_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
