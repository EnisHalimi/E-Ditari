<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function schedule()
    {
        return $this->hasOne('App\Schedule');
    }
}
