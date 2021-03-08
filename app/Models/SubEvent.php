<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubEvent extends Model
{
    use HasFactory;

    protected $table='sub_events';
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(\App\Models\Event::class, 'event_id','id');
    }

    public function participant()
    {
        return $this->hasMany(\App\Models\Participant::class, 'sub_event_id','id');
    }

}
