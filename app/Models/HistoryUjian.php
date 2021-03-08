<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryUjian extends Model
{
    use HasFactory;
    protected $table='history_ujians';
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
