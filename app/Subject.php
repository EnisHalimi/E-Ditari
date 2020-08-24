<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


class Subject extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['name', 'year','school_id'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return  "{$eventName}.{$this->school_id}";
    }

    public function school()
    {
        return $this->hasOne('App\School');
    }

    public function admins()
    {
        return $this->belongsToMany('App\Admin');
    }

    public function grades()
    {
        return $this->hasMany('App\Grade');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    public static function getName($id)
    {
        $subject = Subject::find($id);
        return $subject->name;
    }

}
