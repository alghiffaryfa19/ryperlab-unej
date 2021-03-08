<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(\App\Models\BlogCategory::class, 'category_id','id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id','id');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
