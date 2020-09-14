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

    public static function getGrades($subject, $period, $user,$admin)
    {
        $grade = Grade::where([
            ['subject_id','=',$subject],
            ['period','=',$period],
            ['admin_id','=',$admin],
            ['user_id','=',$user]
            ])->get();
        return $grade;
    }

    public static function getGradeCount($subject, $period,$user,$admin)
    {
        $grade = Grade::where([
            ['subject_id','=',$subject],
            ['period','=',$period],
            ['admin_id','=',$admin],
            ['user_id','=',$user]
            ])->get();
        return $grade->count();
    }

    public static function getFinalGrade($subject,$user,$admin)
    {
        $grades = Grade::where([
            ['subject_id','=',$subject],
            ['admin_id','=',$admin],
            ['user_id','=',$user]
            ])->get();
        $total = 0;
        $average = 0;
        foreach($grades as $grade)
        {
            $total = $total + $grade->grade;
        }
        if($grades->count() != 0)
            $average = $total/$grades->count();

        return round($average,0);
    }

    public static function getPeriodAverage($subject,$period,$user,$admin)
    {
        $grades = Grade::where([
            ['period','=',$period],
            ['subject_id','=',$subject],
            ['admin_id','=',$admin],
            ['user_id','=',$user]
            ])->get();
        $total = 0;
        $average = 0;
        foreach($grades as $grade)
        {
            $total = $total + $grade->grade;
        }
        if($grades->count() != 0)
            $average = $total/$grades->count();
        return round($average,0);
    }
}
