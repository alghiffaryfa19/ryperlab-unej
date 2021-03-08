<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table='participants';
    protected $guarded = [];

    public function sub_event()
    {
        return $this->belongsTo(\App\Models\SubEvent::class, 'sub_event_id','id');
    }
}
