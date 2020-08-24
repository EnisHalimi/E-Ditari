<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;


class Grade extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['subject_id', 'user_id','grade','period','classroom_id','admin_id','school_id'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return  "{$eventName}.{$this->school_id}";
    }

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
