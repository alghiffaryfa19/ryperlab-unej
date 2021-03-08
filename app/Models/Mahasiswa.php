<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table='mahasiswas';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id','id');
    }

    public function enrollment()
    {
        return $this->hasMany(\App\Models\Enrollment::class, 'mahasiswa_id','id');
    }

    public function submission()
    {
        return $this->hasMany(\App\Models\Submissions::class, 'mahasiswa_id','id');
    }

    public function assignment_project()
    {
        return $this->hasMany(\App\Models\AssignmentProject::class, 'mahasiswa_id','id');
    }

    public function history()
    {
        return $this->hasMany(\App\Models\HistoryUjian::class, 'mahasiswa_id','id');
    }

    public function startujian()
    {
        return $this->hasMany(\App\Models\StartUjian::class, 'mahasiswa_id','id');
    }

    public function nilai()
    {
        return $this->hasMany(\App\Models\Nilai::class, 'mahasiswa_id','id');
    }

    public function soaltemp()
    {
        return $this->hasMany(\App\Models\SoalTemp::class, 'mahasiswa_id','id');
    }
}
