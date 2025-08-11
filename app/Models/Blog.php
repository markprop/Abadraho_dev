<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as dbBuilder;


class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $fillable = [
        'title',
        'category_id',
        'description',
        'is_active',
        'slug',
        'cover_img',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_archive',
        'is_archive_by',
        'is_archive_at',
    ];

    protected static function booted()
    {
        // using seperate scope class
        static::addGlobalScope(new HasIsNonArchiveScope);

        // you can do the same thing using anonymous function
        // let's add another scope using anonymous function
        static::addGlobalScope('delete', function (dbBuilder $eloquentDbBuilder) {
            $eloquentDbBuilder->where('is_archive', 0);
        });
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}
