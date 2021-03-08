<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $table='ujians';
    protected $guarded= ['id'];

    public function kelas()
    {
        return $this->belongsTo(\App\Models\Kelas::class, 'kelas_id','id');
    }

    public function soal()
    {
        return $this->hasMany(\App\Models\Soal::class, 'ujian_id','id');
    }

    public function startujian()
    {
        return $this->hasMany(\App\Models\StartUjian::class, 'ujian_id','id');
    }

    public function nilai()
    {
        return $this->hasMany(\App\Models\Nilai::class, 'ujian_id','id');
    }
    
}
