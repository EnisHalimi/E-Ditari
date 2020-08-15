<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }
}
