<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table='nilais';
    protected $guarded= ['id'];


    public function ujian()
    {
        return $this->belongsTo(\App\Models\Ujian::class, 'ujian_id','id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(\App\Models\Mahasiswa::class, 'mahasiswa_id','id');
    }
}
