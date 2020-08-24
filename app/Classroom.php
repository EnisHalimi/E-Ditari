<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Classroom extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['year', 'parallel','school_id','admin_id'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return  "{$eventName}.{$this->school_id}";
    }

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

    public static function getName($id)
    {
        $classroom = Classroom::find($id);
        return $classroom->year.'/'.$classroom->parallel;
    }
}
