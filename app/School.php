<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


class School extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['name', 'city','address','level'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return  "{$eventName}.{$this->id}";
    }

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

    public static function countSchools()
    {
        $schools = School::all();
        return $schools->count();
    }

    public function getPrincipalAttribute()
    {
        $admins = Admin::where('school_id','=',$this->id)->get();
        foreach($admins as $admin)
        {
            if($admin->hasRole('Drejtor'))
                return $admin->full_name;
        }
        return "Nuk ka drejtor";
    }
}
