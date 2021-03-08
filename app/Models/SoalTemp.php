<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalTemp extends Model
{
    use HasFactory;

    protected $table='soal_temps';
    protected $guarded= ['id'];

    public function soal()
    {
        return $this->belongsTo(\App\Models\Soal::class, 'soal_id','id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(\App\Models\Mahasiswa::class, 'mahasiswa_id','id');
    }
}
