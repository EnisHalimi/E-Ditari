<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'fathers_name', 'surname','birthday','address','city','residence','phone_nr','photo','status','isParent','school_id','classroom_id','email','password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function grades()
    {
        return $this->hasMany('App\Grade');
    }

    public function notices()
    {
        return $this->hasMany('App\Notice');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->fathers_name} {$this->surname}";
    }
}
