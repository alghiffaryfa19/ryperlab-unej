<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigments extends Model
{
    use HasFactory;
    protected $table='assigments';
    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsTo(\App\Models\Kelas::class, 'kelas_id','id');
    }

    public function submission()
    {
        return $this->hasMany(\App\Models\Submissions::class, 'assigments_id','id');
    }
}
