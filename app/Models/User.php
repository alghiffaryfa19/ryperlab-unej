<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use jazmy\FormBuilder\Traits\HasFormBuilderTraits;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use \App\Http\Traits\UsesUuid;
    use HasFormBuilderTraits;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function asistant()
    {
        return $this->hasOne(\App\Models\Asistant::class, 'user_id','id');
    }

    public function mahasiswa()
    {
        return $this->hasOne(\App\Models\Mahasiswa::class, 'user_id','id');
    }

    public function post()
    {
        return $this->hasMany(\App\Models\Post::class, 'user_id','id');
    }
}
