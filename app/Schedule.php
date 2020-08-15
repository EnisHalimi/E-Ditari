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
        return $this->belongsTo('App\Admin');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function getFullNameAttribute()
    {
        return    $this->admin->full_name.' - '.$this->subject->name.' '.$this->classroom->class_name.' ('.$this->date.'/'.$this->time.')';
    }
}
