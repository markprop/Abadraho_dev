<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists';
    protected $fillables = [
        
        'user_id',
        'product_id',
        'status'
    ];

    public function projects() {
        return $this->belongsTo(Project::class, 'product_id', 'id')->where('is_archive', '0');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id')->where('is_archive', '0');
    }
}
