<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

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
        return $this->belongsTo('App\Admin');
    }

    public function getStudentCountAttribute()
    {
        return User::where('classroom_id','=',$this->id)->count();
    }

    public function getClassNameAttribute()
    {
        return $this->year.'/'.$this->parallel;
    }
}
