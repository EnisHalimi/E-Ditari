<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = [ 'first_name', 'fathers_name', 'surname','birthday','address','city','residence','phone_nr','photo','status','isParent','school_id','classroom_id','email','password'];

    protected $fillable = [
        'first_name', 'fathers_name', 'surname','birthday','address','city','residence','phone_nr','photo','status','isParent','school_id','classroom_id','email','password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return  "{$eventName}.{$this->school_id}";
    }

    public function grades()
    {
        return $this->hasMany('App\Grade');
    }

    public function notices()
    {
        return $this->hasMany('App\Notice');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->fathers_name} {$this->surname}";
    }

    public static function getFullName($id)
    {
        $user = User::find($id);
        return $user->full_name;
    }

    public function getItsParentAttribute()
    {
        if($this->isParent == null)
            return false;
        else
            return true;
    }

    public function getBirthdayDateAttribute()
    {
        return date('d/m/Y', strtotime($this->birthday));
    }

    public function getAverageGradeAttribute()
    {
        $grades = $this->grades()->get();
        $total = 0;
        $average = 0;
        foreach($grades as $grade)
        {
            $total = $total + $grade->grade;
        }
        if($grades->count() != 0)
            $average = $total/$grades->count();
            return number_format($average,2);
    }

    public function getFirstPeriodAverageAttribute()
    {
        $grades = $this->grades()->where('period','=',1)->get();
        $total = 0;
        $average = 0;
        foreach($grades as $grade)
        {
            $total = $total + $grade->grade;
        }
        if($grades->count() != 0)
            $average = $total/$grades->count();
        return number_format($average,2);
    }

    public function getSecondPeriodAverageAttribute()
    {
        $grades = $this->grades()->where('period','=',2)->get();
        $total = 0;
        $average = 0;
        foreach($grades as $grade)
        {
            $total = $total + $grade->grade;
        }
        if($grades->count() != 0)
            $average = $total/$grades->count();
            return number_format($average,2);
    }

    public function getThirdPeriodAverageAttribute()
    {
        $grades = $this->grades()->where('period','=',3)->get();
        $total = 0;
        $average = 0;
        foreach($grades as $grade)
        {
            $total = $total + $grade->grade;
        }
        if($grades->count() != 0)
            $average = $total/$grades->count();
            return number_format($average,2);
    }

    public function getAllAbsencesAttribute()
    {
        $absences = $this->notices()->where('description','=','Munges')->count();
        return $absences;
    }

    public function getFatherNameAttribute()
    {
        $user = User::where([
                ['isParent', '=',$this->id],
                ['gender', '=', 'M'],
            ])->first();
        if(is_null($user))
            return "Nuk ka te dhena";
        return $user->full_name;
    }

    public function getMotherNameAttribute()
    {
        $user = User::where([
            ['isParent', '=',$this->id],
            ['gender', '=', 'F'],
        ])->first();
        if(is_null($user))
            return "Nuk ka te dhena";
        return $user->full_name;
    }

    public function getFatherAddressAttribute()
    {
        $user = User::where([
                ['isParent', '=',$this->id],
                ['gender', '=', 'M'],
            ])->first();
        if(is_null($user))
            return "Nuk ka te dhena";
        return $user->address;
    }

    public function getMotherAddressAttribute()
    {
        $user = User::where([
            ['isParent', '=',$this->id],
            ['gender', '=', 'F'],
        ])->first();
        if(is_null($user))
            return "Nuk ka te dhena";
        return $user->address;
    }

    public function getFatherJobAttribute()
    {
        $user = User::where([
                ['isParent', '=',$this->id],
                ['gender', '=', 'M'],
            ])->first();
        if(is_null($user))
            return "Nuk ka te dhena";
        return $user->status;
    }

    public function getMotherJobAttribute()
    {
        $user = User::where([
            ['isParent', '=',$this->id],
            ['gender', '=', 'F'],
        ])->first();
        if(is_null($user))
            return "Nuk ka te dhena";
        return $user->status;
    }

    public function getFatherPhoneAttribute()
    {
        $user = User::where([
                ['isParent', '=',$this->id],
                ['gender', '=', 'M'],
            ])->first();
        if(is_null($user))
            return "Nuk ka te dhena";
        return $user->phone_nr;
    }

    public function getMotherPhoneAttribute()
    {
        $user = User::where([
            ['isParent', '=',$this->id],
            ['gender', '=', 'F'],
        ])->first();
        if(is_null($user))
            return "Nuk ka te dhena";
        return $user->phone_nr;
    }

    public function getFatherEmailAttribute()
    {
        $user = User::where([
                ['isParent', '=',$this->id],
                ['gender', '=', 'M'],
            ])->first();
        if(is_null($user))
            return "Nuk ka te dhena";
        return $user->email;
    }

    public function getMotherEmailAttribute()
    {
        $user = User::where([
            ['isParent', '=',$this->id],
            ['gender', '=', 'F'],
        ])->first();
        if(is_null($user))
            return "Nuk ka te dhena";
        return $user->email;
    }

    public function getFirstPeriodGradesAttribute()
    {
        $grades = $this->grades()->where('period','=',1)->get();
        return $grades;
    }

    public function getSecondPeriodGradesAttribute()
    {
        $grades = $this->grades()->where('period','=',2)->get();
        return $grades;
    }

    public function getThirdPeriodGradesAttribute()
    {
        $grades = $this->grades()->where('period','=',3)->get();
        return $grades;
    }
}
