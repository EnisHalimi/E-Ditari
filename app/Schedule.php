<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function notices()
    {
        return $this->hasMany('App\Notice');
    }

    public function admin()
    {
        return $this->hasOne('App\Admin');
    }

    public function subject()
    {
        return $this->hasOne('App\Subject');
    }

    public function classroom()
    {
        return $this->hasOne('App\Classroom');
    }
}
