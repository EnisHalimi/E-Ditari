<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Classroom;
use App\Admin;
use App\Subject;
use Auth;
use Carbon\Carbon;
use Redirect,Response;

class ScheduleController extends Controller
{

    public function getSchedules(Request $request)
    {
        if($request->id !=null)
        $id = $request->id;
        $schedules = Schedule::where('classroom_id','=',$id)->get();
        $data[] = [];
        foreach($schedules as $schedule)
        {
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s', $schedule->date.' '.$schedule->time);
            $timeToAdd = $startDate;
            $endDate = $timeToAdd->addHours(1);
            $data[] = array(
                'title' => $schedule->subject->name,
                'start' => $startDate,
                'end' => $endDate,
                'backgroundColor' => '#1cc88a',
                'borderColor' =>  '$3a3b45',
                'url' => route('admin.schedule.edit',$schedule->id),
            );
        }

        return Response::json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::where('school_id','=',Auth::user()->school_id)->paginate(20);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-schedule', 'admin'))
            return view('admin.schedule.index')->with('classrooms',$classrooms);
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
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
        if(Auth::guard('admin')->user()->hasPermissionTo('create-schedule', 'admin'))
            return view('admin.schedule.create')->with('classrooms',$classrooms)->with('subjects',$subjects)->with('admins',$admins);
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::guard('admin')->user()->hasPermissionTo('create-schedule', 'admin')){
            $this->validate($request,[
            'Data'=> 'required|date',
            'Profesori' => 'required',
            'Klasa' => 'required',
            'Lenda' => 'required',
            ]);
            $schedule = new Schedule;
            $schedule->date = $request->input('Data');
            $schedule->time = $request->input('Ora');
            $schedule->classroom_id = $request->input('Klasa');
            $schedule->admin_id = $request->input('Profesori');
            $schedule->subject_id = $request->input('Lenda');
            $schedule->school_id = Auth::user()->school_id;
            $schedule->save();
            return redirect(route('admin.schedule.index'))->with('success',__('messages.schedule-add'));
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        if(empty($request->input('date')))
            $date = date('Y-m-d');
        else
            $date = $request->input('date');
        $carbonDate = Carbon::createFromFormat('Y-m-d',$date);
        $year = $carbonDate->year;
        $week =  $carbonDate->weekOfYear;
        $startDate = $carbonDate->setISODate($year, $week);
        $endDate=   $carbonDate->setISODate($year, $week, 5);
        $monday = $startDate;
        $tuesday = $monday->addDay();
        $wendesday = $tuesday->addDay();
        $thursday = $wendesday->addDay();
        $friday = $thursday->addDay();
        $classroom = Classroom::find($id);
        $schedules = Schedule::whereDate('date', $startDate)->get();

        if(Auth::guard('admin')->user()->hasPermissionTo('view-schedule', 'admin'))
            return view('admin.schedule.show')->with('schedules',$schedules)->with('classroom',$classroom)->with('date', $date)
            ->with('monday',$monday)
            ->with('tuesday',$tuesday)
            ->with('wendesday',$wendesday)
            ->with('thursday',$thursday)
            ->with('friday',$friday);
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
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
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-schedule', 'admin'))
            return view('admin.schedule.edit')->with('schedule',$schedule)->with('classrooms',$classrooms)->with('subjects',$subjects)->with('admins',$admins);
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
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
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-schedule', 'admin')){
            $this->validate($request,[
                'Data'=> 'required|date',
                'Profesori' => 'required',
                'Klasa' => 'required',
                'Lenda' => 'required',
            ]);
            $schedule =  Schedule::find($id);
            $schedule->date = $request->input('Data');
            $schedule->time = $request->input('Ora');
            $schedule->classroom_id = $request->input('Klasa');
            $schedule->admin_id = $request->input('Profesori');
            $schedule->subject_id = $request->input('Lenda');
            $schedule->school_id = Auth::user()->school_id;
            $schedule->save();
            return redirect(route('admin.schedule.index'))->with('success',__('messages.schedule-edit'));
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::guard('admin')->user()->hasPermissionTo('delete-schedule', 'admin')){
            $schedule = Schedule::find($id);
            $schedule->notices()->delete();
            $schedule->delete();
            return redirect(route('admin.schedule.index'))->with('success',__('messages.schedule-delete'));
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }
}
