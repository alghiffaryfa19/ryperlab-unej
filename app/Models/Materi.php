<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table='materis';
    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(\App\Models\Kelas::class, 'kelas_id','id');
    }
}
