<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    use HasFactory;
    protected $table='project_galleries';
    protected $guarded = [];

    public function assignment_project()
    {
        return $this->belongsTo(\App\Models\AssignmentProject::class, 'assigment_project_id','id');
    }
}
