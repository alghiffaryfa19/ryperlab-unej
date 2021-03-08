<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table='blog_categories';
    protected $guarded = [];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function post()
    {
        return $this->hasMany(\App\Models\Post::class, 'category_id','id');
    }
}
