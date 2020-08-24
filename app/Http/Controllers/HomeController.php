<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->its_parent == true)
            $user = User::where('id','=',Auth::user()->isParent)->first();
        else
            $user = User::where('id','=',Auth::user()->id)->first();
        return view('user.index')->with('user',$user);
    }

    public function moodle()
    {
        if(Auth::user()->its_parent == true)
            $user = User::where('id','=',Auth::user()->isParent)->first();
        else
            $user = User::where('id','=',Auth::user()->id)->first();
        return view('user.moodle')->with('user',$user);
    }

    public function calendar()
    {
        if(Auth::user()->its_parent == true)
            $user = User::where('id','=',Auth::user()->isParent)->first();
        else
            $user = User::where('id','=',Auth::user()->id)->first();
        return view('user.calendar')->with('user',$user);
    }

    public function adminIndex()
    {
        return view('admin.admin');
    }

     public function adminLogs()
    {
        $activities = Activity::where('description','LIKE','%.'.Auth::user()->school_id)->get();
        return view('admin.logs')->with('activities',$activities);
    }

    public function markAsRead(Request $request)
    {
        if($request->ajax())
        {
            $notification = DB::table('notifications')->where('id','=',$request->input('id'))
              ->update(['opened' => true]);
            return response()->json(['success'=>'U markua si e lexuar.']);
        }
    }
}
