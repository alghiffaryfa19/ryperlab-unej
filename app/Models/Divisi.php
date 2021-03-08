<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table='divisis';
    protected $guarded = [];

    public function asistant()
    {
        return $this->hasMany(\App\Models\Asistant::class, 'divisi_id','id');
    }
}
