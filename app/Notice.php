<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Notice extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['description', 'user_id','schedule_id','school_id'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return  "{$eventName}.{$this->school_id}";
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Schedule');
    }

    public static function getNoticesCount($user,$arsyeshme)
    {
        $notices = Notice::where([
            ['arsyeshme','=',$arsyeshme],
            ['user_id','=',$user]
            ])->get();
        return $notices->count();
    }
}
