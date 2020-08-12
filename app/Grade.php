<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function subject()
    {
        return $this->hasOne('App\Subject');
    }

    public function classroom()
    {
        return $this->hasOne('App\Classroom');
    }

    public function admin()
    {
        return $this->hasOne('App\Admin');
    }

    public function school()
    {
        return $this->hasOne('App\School');
    }
}
