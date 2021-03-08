<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    use HasFactory;
    protected $table='submissions';
    protected $guarded = [];

    public function assigment()
    {
        return $this->belongsTo(\App\Models\Assigments::class, 'assigments_id','id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(\App\Models\Mahasiswa::class, 'mahasiswa_id','id');
    }
}
