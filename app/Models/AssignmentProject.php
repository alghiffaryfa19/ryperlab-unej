<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AssignmentProject extends Model
{
    use HasFactory;
    protected $table='assignment_projects';
    protected $guarded = [];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function projects()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id','id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(\App\Models\Mahasiswa::class, 'mahasiswa_id','id');
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\AppCategory::class, 'category_id','id');
    }

    public function galeri()
    {
        return $this->hasMany(\App\Models\ProjectGallery::class, 'assigment_project_id','id');
    }

    public function member()
    {
        return $this->hasMany(\App\Models\ProjectMember::class, 'assigment_project_id','id');
    }
}
