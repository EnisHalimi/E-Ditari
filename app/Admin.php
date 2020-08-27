<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use DB;



class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;
    use LogsActivity;

    protected $guard = 'admin';

    protected static $logAttributes = [ 'first_name', 'fathers_name', 'surname','birthday','address','city','residence','phone_nr','photo','grade','school_id','email','password'];

    protected $fillable = [
        'first_name', 'fathers_name', 'surname','birthday','address','city','residence','phone_nr','photo','grade','school_id','email','password'
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

    public function subjects()
    {
        return $this->belongsToMany('App\Subject');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    public function classroom()
    {
        return $this->hasOne('App\Classroom');
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

    public static function countAdmins()
    {
        $admins = Admin::all();
        return $admins->count();
    }

    public static function getFullName($id)
    {
        $admin = Admin::find($id);
        return $admin->full_name;
    }

    public function getNotificationsAttribute()
    {
        $notifications = DB::table('notifications')->where([['admin_id', '=', $this->id],
        ['opened', '=', false],])->get();
        if($notifications->count() == 0)
                return 0;
        return $notifications;
    }

    public function getNotificationsCountAttribute()
    {
        $notifications = DB::table('notifications')->where([['admin_id', '=', $this->id],
        ['opened', '=', false],])->get();
        return $notifications->count();
    }
}
