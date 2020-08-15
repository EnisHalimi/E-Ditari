<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class School extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function classrooms()
    {
        return $this->hasMany('App\Classroom');
    }

    public function admins()
    {
        return $this->hasMany('App\Admin');
    }

    public function getPrincipalAttribute()
    {
        $admin = Admin::find($this->principal_id);
        return $admin->full_name;
    }
}
