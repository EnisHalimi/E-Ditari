<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Classroom;
use App\Admin;
use App\Subject;
use Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::where('school_id','=',Auth::user()->school_id)->paginate(20);
        if(Auth::guard('admin'))
            return view('admin.schedule.index')->with('schedules',$schedules);
        else
            return redirect('/home')->with('error','No access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = Classroom::where('school_id','=',Auth::user()->school_id)->get();
        $subjects = Subject::where('school_id','=',Auth::user()->school_id)->get();
        $admins = Admin::where('school_id','=',Auth::user()->school_id)->get();
        if(Auth::guard('admin'))
            return view('admin.schedule.create')->with('classrooms',$classrooms)->with('subjects',$subjects)->with('admins',$admins);
        else
            return redirect('/home')->with('error','No access');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'Data'=> 'required|date',
        ]);
        $schedule = new Schedule;
        $schedule->date = $request->input('Data');
        $schedule->time = $request->input('Ora');
        $schedule->classroom_id = $request->input('Klasa');
        $schedule->admin_id = $request->input('Profesori');
        $schedule->subject_id = $request->input('Lenda');
        $schedule->school_id = Auth::user()->school_id;
        $schedule->save();
        return redirect('/admin/schedule')->with('success','U shtua orari');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        if(Auth::guard('admin'))
            return view('admin.schedule.show')->with('schedule',$schedule);
        else
            return redirect('/home')->with('error','No access');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classrooms = Classroom::where('school_id','=',Auth::user()->school_id)->get();
        $subjects = Subject::where('school_id','=',Auth::user()->school_id)->get();
        $admins = Admin::where('school_id','=',Auth::user()->school_id)->get();
        $schedule = Schedule::find($id);
        if(Auth::guard('admin'))
            return view('admin.schedule.edit')->with('schedule',$schedule)->with('classrooms',$classrooms)->with('subjects',$subjects)->with('admins',$admins);
        else
            return redirect('/home')->with('error','No access');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'Data'=> 'required|date',
         ]);
         $schedule =  Schedule::find($id);
         $schedule->date = $request->input('Data');
         $schedule->time = $request->input('Ora');
         $schedule->classroom_id = $request->input('Klasa');
         $schedule->admin_id = $request->input('Profesori');
         $schedule->subject_id = $request->input('Lenda');
         $schedule->school_id = Auth::user()->school_id;
         $schedule->save();
         return redirect('/admin/schedule')->with('success','U ndryshua orari');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        $schedule->notices()->delete();
        $schedule->delete();
        return redirect('/admin/schedule')->with('success','U fshi orari');
    }
}
