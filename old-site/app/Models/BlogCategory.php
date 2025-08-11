<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\HasIsNonArchiveScope;
use Illuminate\Database\Eloquent\Builder as eloquentBuilder;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table = 'blog_category';

    protected $fillable = [
        'title',
        'slug',
        "is_archive",
        "is_archive_by",
        "is_archive_at",
    ];

    protected static function booted()
    {
        // using seperate scope class
        static::addGlobalScope(new HasIsNonArchiveScope);

        // you can do the same thing using anonymous function
        // let's add another scope using anonymous function
        static::addGlobalScope('delete', function (eloquentBuilder $builder) {
            $builder->where('is_archive', 0);
        });
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
