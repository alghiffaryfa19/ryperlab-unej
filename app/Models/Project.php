<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table='projects';
    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(\App\Models\Kelas::class, 'kelas_id','id');
    }

    public function assignments()
    {
        return $this->hasMany(\App\Models\AssignmentProject::class, 'project_id','id');
    }
}
