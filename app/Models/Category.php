<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'parent_id',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the posts associated with the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }

    public function child_categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
