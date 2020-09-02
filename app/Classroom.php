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


    public function getSubjectsAttribute()
    {
        $subjects = $this->schedules()->select('subject_id', 'admin_id')->distinct()->get();
        return $subjects;
    }

    public static function getName($id)
    {
        $classroom = Classroom::find($id);
        return $classroom->year.'/'.$classroom->parallel;
    }

    public function getFemaleCountAttribute()
    {
        $users = $this->users()->where('gender','=','F')->get();
        return $users->count();
    }

    public function getMaleCountAttribute()
    {
        $users = $this->users()->where('gender','=','M')->get();
        return $users->count();
    }

    public function getFemaleActiveAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        return $users->count();
    }

    public function getMaleActiveAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        return $users->count();
    }

    public function getFemaleNotactiveAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','!=','Aktiv']])->get();
        return $users->count();
    }

    public function getMaleNotactiveAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','!=','Aktiv']])->get();
        return $users->count();
    }

    public function getNotActiveAttribute()
    {
        $users = $this->users()->where('status','!=','Aktiv')->get();
        return $users;
    }

    public function getFemaleExcellentfpAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->first_period_average > 4.5)
                $count++;
        }
        return $count;
    }

    public function getMaleExcellentfpAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->first_period_average > 4.5)
                $count++;
        }
        return $count;
    }


    public function getFemaleGoodfpAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->first_period_average > 3.5)
                $count++;
        }
        return $count;
    }

    public function getMaleGoodfpAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->first_period_average > 3.5)
                $count++;
        }
        return $count;
    }

    public function getFemaleAvgfpAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->first_period_average > 2.5)
                $count++;
        }
        return $count;
    }

    public function getMaleAvgfpAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->first_period_average > 2.5)
                $count++;
        }
        return $count;
    }

    public function getFemaleBadfpAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->first_period_average > 1.5)
                $count++;
        }
        return $count;
    }

    public function getMaleBadfpAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->first_period_average > 1.5)
                $count++;
        }
        return $count;
    }

    public function getFemaleWorsefpAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->first_period_average < 1.5)
                $count++;
        }
        return $count;
    }

    public function getMaleWorsefpAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->first_period_average < 1.5 )
                $count++;
        }
        return $count;
    }

    public function getFemaleExcellentspAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->second_period_average > 4.5)
                $count++;
        }
        return $count;
    }

    public function getMaleExcellentspAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->second_period_average > 4.5)
                $count++;
        }
        return $count;
    }


    public function getFemaleGoodspAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->second_period_average > 3.5)
                $count++;
        }
        return $count;
    }

    public function getMaleGoodspAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->second_period_average > 3.5)
                $count++;
        }
        return $count;
    }

    public function getFemaleAvgspAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->second_period_average > 2.5)
                $count++;
        }
        return $count;
    }

    public function getMaleAvgspAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->second_period_average > 2.5)
                $count++;
        }
        return $count;
    }

    public function getFemaleBadspAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->second_period_average > 1.5)
                $count++;
        }
        return $count;
    }

    public function getMaleBadspAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->second_period_average > 1.5)
                $count++;
        }
        return $count;
    }

    public function getFemaleWorsespAttribute()
    {
        $users = $this->users()->where([['gender','=','F'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->second_period_average < 1.5)
                $count++;
        }
        return $count;
    }

    public function getMaleWorsespAttribute()
    {
        $users = $this->users()->where([['gender','=','M'],['status','=','Aktiv']])->get();
        $count = 0;
        foreach($users as $user)
        {
            if($user->second_period_average < 1.5 )
                $count++;
        }
        return $count;
    }
}
