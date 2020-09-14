<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Auth;
use DB;

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

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->surname}";
    }

    public static function getFullName($id)
    {
        $user = User::find($id);
        return $user->full_name;
    }

    public function getNotificationsAttribute()
    {
        $notifications = DB::table('notifications')->where([['user_id', '=', $this->id],
        ['opened', '=', false],])->get();
        if($notifications->count() == 0)
                return 0;
        return $notifications;
    }

    public function getNotificationsCountAttribute()
    {
        $notifications = DB::table('notifications')->where([['user_id', '=', $this->id],
        ['opened', '=', false],])->get();
        return $notifications->count();
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

    public function getParentsAttribute()
    {
        $parents = User::where('isParent','=',$this->id)->get();
        return $parents;
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
            return round($average,0);
    }

    public function getFirstPeriodAverageAttribute()
    {
        $grades = $this->grades()->where([['period','=',1],['admin_id','=',Auth::user()->id]])->get();
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

    public static function countUsers()
    {
        $users = User::where([['isParent','=',null],['school_id','=', Auth::user()->school_id]]);
        return $users->count();
    }

    public static function countFemaleUsers()
    {
        $users = User::where([['isParent','=',null],['gender','=','F'],['school_id','=', Auth::user()->school_id]]);
        return $users->count();
    }

    public static function countMaleUsers()
    {
        $users = User::where([['isParent','=',null],['gender','=','M'],['school_id','=', Auth::user()->school_id]]);
        return $users->count();
    }

    public static function countParents()
    {
        $users = User::where([['isParent','!=',null],['school_id','=', Auth::user()->school_id]]);
        return $users->count();
    }


    public function getSecondPeriodAverageAttribute()
    {
        $grades = $this->grades()->where([['period','=',2],['admin_id','=',Auth::user()->id]])->get();
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

    public function getThirdPeriodAverageAttribute()
    {
        $grades = $this->grades()->where([['period','=',3],['admin_id','=',Auth::user()->id]])->get();
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

    public function getAllAbsencesAttribute()
    {
        $absences = $this->notices()->where('arsyeshme','!=',0)->count();
        return $absences;
    }

    public function getAbsencesAttribute()
    {
        $absences = $this->notices()->where('arsyeshme','!=',0)->get();
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
        $grades = $this->grades()->where([['period','=',1],['admin_id','=',Auth::user()->id]])->get();
        return $grades;
    }

    public function getSecondPeriodGradesAttribute()
    {
        $grades = $this->grades()->where([['period','=',2],['admin_id','=',Auth::user()->id]])->get();
        return $grades;
    }

    public function getThirdPeriodGradesAttribute()
    {
        $grades = $this->grades()->where([['period','=',3],['admin_id','=',Auth::user()->id]])->get();
        return $grades;
    }
}
