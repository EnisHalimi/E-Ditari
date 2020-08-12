<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    public function admin()
    {
        return $this->hasOne('App\Admins');
    }
}
