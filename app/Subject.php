<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function school()
    {
        return $this->hasOne('App\School');
    }

    public function admins()
    {
        return $this->hasMany('App\Admin');
    }

    public function grades()
    {
        return $this->hasMany('App\Grade');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }
}
