<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table='events';
    protected $guarded = [];

    public function sub_event()
    {
        return $this->hasMany(\App\Models\SubEvent::class, 'event_id','id');
    }
}
