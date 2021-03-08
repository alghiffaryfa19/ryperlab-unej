<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $table='soals';
    protected $guarded= ['id'];

    public function ujian()
    {
        return $this->belongsTo(\App\Models\Ujian::class, 'ujian_id','id');
    }

    public function history()
    {
        return $this->hasMany(\App\Models\HistoryUjian::class, 'soal_id','id');
    }

    public function soaltemp()
    {
        return $this->hasMany(\App\Models\SoalTemp::class, 'soal_id','id');
    }
}
