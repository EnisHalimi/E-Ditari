<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'first_name', 'fathers_name', 'surname','birthday','address','city','residence','phone_nr','photo','grade','school_id','email','password'
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

    public function subjects()
    {
        return $this->belongsToMany('App\Subject');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    public function classroom()
    {
        return $this->hasOne('App\Classroom');
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
