<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table='mata_kuliahs';
    protected $guarded = [];

    public function asistant()
    {
        return $this->hasMany(\App\Models\Asistant::class, 'matkul_id','id');
    }

    public function kelas()
    {
        return $this->hasMany(\App\Models\Kelas::class, 'matkul_id','id');
    }
}
