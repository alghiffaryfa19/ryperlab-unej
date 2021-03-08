<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table='kelas';
    protected $guarded = [];

    // public function asistant()
    // {
    //     return $this->belongsTo(\App\Models\Asistant::class, 'assitant_id','id');
    // }

    public function asistant()
    {
        return $this->belongsToMany('App\Models\Asistant');
    }

    public function matkul()
    {
        return $this->belongsTo(\App\Models\MataKuliah::class, 'matkul_id','id');
    }

    public function enrollment()
    {
        return $this->hasMany(\App\Models\Enrollment::class, 'kelas_id','id');
    }

    public function assignment()
    {
        return $this->hasMany(\App\Models\Assigments::class, 'kelas_id','id');
    }

    public function materi()
    {
        return $this->hasMany(\App\Models\Materi::class, 'kelas_id','id');
    }

    public function ujian()
    {
        return $this->hasMany(\App\Models\Ujian::class, 'kelas_id','id');
    }

    public function projects()
    {
        return $this->hasMany(\App\Models\Project::class, 'kelas_id','id');
    }

    public function kuesioner()
    {
        return $this->hasMany(\jazmy\FormBuilder\Models\Form::class, 'kelas_id','id');
    }
}
