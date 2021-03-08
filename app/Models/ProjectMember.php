<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    use HasFactory;
    protected $table='project_members';
    protected $guarded = [];

    public function assignment_project()
    {
        return $this->belongsTo(\App\Models\AssignmentProject::class, 'assigment_project_id','id');
    }
}
