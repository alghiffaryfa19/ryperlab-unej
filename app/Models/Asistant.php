<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistant extends Model
{
    use HasFactory;
    protected $table='asistants';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id','id');
    }

    // public function kelas()
    // {
    //     return $this->hasMany(\App\Models\Kelas::class, 'assitant_id','id');
    // }

    public function kelas()
    {
        return $this->belongsToMany('App\Models\Kelas');
    }

    public function divisi()
    {
        return $this->belongsTo(\App\Models\Divisi::class, 'divisi_id','id');
    }
    
}
