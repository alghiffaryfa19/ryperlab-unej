<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $table='enrollments';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(\App\Models\Mahasiswa::class, 'mahasiswa_id','id');
    }

    public function kelas()
    {
        return $this->belongsTo(\App\Models\Kelas::class, 'kelas_id','id');
    }
}
