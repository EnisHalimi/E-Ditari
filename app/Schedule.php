<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Schedule extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['date', 'time','subject_id','classroom_id','admin_id','school_id'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return  "{$eventName}.{$this->school_id}";
    }

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

    public static function getName($id)
    {
        $schedule = Schedule::find($id);
        return  $schedule->admin->full_name.' - '.$schedule->subject->name.' '.$schedule->classroom->class_name.' ('.$schedule->date.'/'.$schedule->time.')';
    }
}
