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
use DB;

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
            $startDate = new Carbon($schedule->date.' '.$schedule->time);
            $data[] = array(
                'title' => $schedule->subject->name.'-'.$schedule->admin->name,
                'start' => $startDate->subHour(),
                'end' => $startDate->addHour(),
                'backgroundColor' => '#1cc88a',
                'borderColor' =>  '$3a3b45',
                'url' => route('admin.schedule.edit',$schedule->id),
            );
        }

        return Response::json($data);
    }

    public function dayOff(Request $request)
    {
        if(Auth::guard('admin')->user()->hasPermissionTo('create-schedule', 'admin'))
        {
            $classroom = Classroom::find($request->classroom_id);
            $schedules = DB::table('schedules')->where([['date', '=', $request->date],['classroom_id','=',$classroom->id]])->delete();
            $students = $classroom->users()->get();
            foreach($students as $student)
            {
                $remove = DB::table('notifications')->insert([
                            'user_id' =>  $student->id,
                            'admin_id'=> 0,
                            'description' =>  'Me date '.$request->date.' do te jete dite pushimi.',
                            'opened' =>  false]);
            }
            $remove2 = DB::table('notifications')->insert([
                            'user_id' => 0,
                            'admin_id'=> $classroom->admin->id,
                            'description' =>  'Me date '.$request->date.' do te jete dite pushimi.',
                            'opened' =>  false  ]);
            return redirect()->back()->with('success','Dita u be pushim');
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));


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
    public function create(Request $request)
    {
        $classroom = $request->classroom_id;
        $class = Classroom::find($classroom);
        $subjects = Subject::where([['school_id','=',Auth::user()->school_id],['year','=',$class->year]])->get();
        $admins = Admin::where('school_id','=',Auth::user()->school_id)->get();
        if(Auth::guard('admin')->user()->hasPermissionTo('create-schedule', 'admin'))
            return view('admin.schedule.create')->with('classroom',$classroom)->with('subjects',$subjects)->with('admins',$admins);
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
            $start_date = new Carbon($request->input('start-date'));
            $date = new Carbon ($request->input('start-date'));
            $end_date = new Carbon($request->input('end-date'));
            $deletedRow = Schedule::where('school_id','=',Auth::user()->school_id)->whereBetween('date',  [$start_date, $end_date])->delete();
           while($date->lessThan($end_date)) {
                if($date->isMonday())
                {
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '08:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-h-1');
                    $schedule->subject_id = $request->input('subject-h-1');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-h-1'));
                    $subject = Subject::find($request->input('subject-h-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '09:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-h-2');
                    $schedule->subject_id = $request->input('subject-h-2');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-h-2'));
                    $subject = Subject::find($request->input('subject-h-2'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '10:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-h-3');
                    $schedule->subject_id = $request->input('subject-h-3');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-h-3'));
                    $subject = Subject::find($request->input('subject-h-3'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '11:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-h-4');
                    $schedule->subject_id = $request->input('subject-h-4');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-h-4'));
                    $subject = Subject::find($request->input('subject-h-4'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '12:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-h-5');
                    $schedule->subject_id = $request->input('subject-h-5');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-h-5'));
                    $subject = Subject::find($request->input('subject-h-5'));
                    $admin->subjects()->attach($subject);
                    if($request->input('admin-h-6') != 'jo' || $request->input('subject-h-6') != 'jo')
                    {
                        $schedule = new Schedule;
                        $schedule->date = $date;
                        $schedule->time = '13:00:00';
                        $schedule->classroom_id = $request->input('classroom_id');
                        $schedule->admin_id = $request->input('admin-h-6');
                        $schedule->subject_id = $request->input('subject-h-6');
                        $schedule->school_id = Auth::user()->school_id;
                        $schedule->save();

                        $admin = Admin::find($request->input('admin-h-6'));
                        $subject = Subject::find($request->input('subject-h-6'));
                        $admin->subjects()->attach($subject);
                    }
                }
                elseif($date->isTuesday())
                {
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '08:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-mr-1');
                    $schedule->subject_id = $request->input('subject-mr-1');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-mr-1'));
                    $subject = Subject::find($request->input('subject-mr-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '09:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-mr-2');
                    $schedule->subject_id = $request->input('subject-mr-2');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-mr-1'));
                    $subject = Subject::find($request->input('subject-mr-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '10:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-mr-3');
                    $schedule->subject_id = $request->input('subject-mr-3');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-mr-1'));
                    $subject = Subject::find($request->input('subject-mr-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '11:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-mr-4');
                    $schedule->subject_id = $request->input('subject-mr-4');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-mr-1'));
                    $subject = Subject::find($request->input('subject-mr-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '12:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-mr-5');
                    $schedule->subject_id = $request->input('subject-mr-5');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-mr-1'));
                    $subject = Subject::find($request->input('subject-mr-1'));
                    $admin->subjects()->attach($subject);
                    if($request->input('admin-mr-6') != 'jo' || $request->input('subject-mr-6') != 'jo')
                    {
                        $schedule = new Schedule;
                        $schedule->date = $date;
                        $schedule->time = '13:00:00';
                        $schedule->classroom_id = $request->input('classroom_id');
                        $schedule->admin_id = $request->input('admin-mr-6');
                        $schedule->subject_id = $request->input('subject-mr-6');
                        $schedule->school_id = Auth::user()->school_id;
                        $schedule->save();
                        $admin = Admin::find($request->input('admin-mr-1'));
                        $subject = Subject::find($request->input('subject-mr-1'));
                        $admin->subjects()->attach($subject);
                    }
                }
                elseif($date->isWednesday())
                {
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '08:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-mk-1');
                    $schedule->subject_id = $request->input('subject-mk-1');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-mk-1'));
                    $subject = Subject::find($request->input('subject-mk-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '09:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-mk-2');
                    $schedule->subject_id = $request->input('subject-mk-2');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-mk-1'));
                    $subject = Subject::find($request->input('subject-mk-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '10:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-mk-3');
                    $schedule->subject_id = $request->input('subject-mk-3');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-mk-1'));
                    $subject = Subject::find($request->input('subject-mk-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '11:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-mk-4');
                    $schedule->subject_id = $request->input('subject-mk-4');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-mk-1'));
                    $subject = Subject::find($request->input('subject-mk-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '12:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-mk-5');
                    $schedule->subject_id = $request->input('subject-mk-5');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-mk-1'));
                    $subject = Subject::find($request->input('subject-mk-1'));
                    $admin->subjects()->attach($subject);
                    if($request->input('admin-mk-6') != 'jo' || $request->input('subject-mk-6') != 'jo')
                    {
                        $schedule = new Schedule;
                        $schedule->date = $date;
                        $schedule->time = '13:00:00';
                        $schedule->classroom_id = $request->input('classroom_id');
                        $schedule->admin_id = $request->input('admin-mk-6');
                        $schedule->subject_id = $request->input('subject-mk-6');
                        $schedule->school_id = Auth::user()->school_id;
                        $schedule->save();
                        $admin = Admin::find($request->input('admin-mk-1'));
                        $subject = Subject::find($request->input('subject-mk-1'));
                        $admin->subjects()->attach($subject);
                    }
                }
                elseif($date->isThursday())
                {
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '08:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-e-1');
                    $schedule->subject_id = $request->input('subject-e-1');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-e-1'));
                    $subject = Subject::find($request->input('subject-e-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '09:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-e-2');
                    $schedule->subject_id = $request->input('subject-e-2');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-e-1'));
                    $subject = Subject::find($request->input('subject-e-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '10:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-e-3');
                    $schedule->subject_id = $request->input('subject-e-3');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-e-1'));
                    $subject = Subject::find($request->input('subject-e-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '11:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-e-4');
                    $schedule->subject_id = $request->input('subject-e-4');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-e-1'));
                    $subject = Subject::find($request->input('subject-e-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '12:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-e-5');
                    $schedule->subject_id = $request->input('subject-e-5');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-e-1'));
                    $subject = Subject::find($request->input('subject-e-1'));
                    $admin->subjects()->attach($subject);
                    if($request->input('admin-e-6') != 'jo' || $request->input('subject-e-6') != 'jo')
                    {
                        $schedule = new Schedule;
                        $schedule->date = $date;
                        $schedule->time = '13:00:00';
                        $schedule->classroom_id = $request->input('classroom_id');
                        $schedule->admin_id = $request->input('admin-e-6');
                        $schedule->subject_id = $request->input('subject-e-6');
                        $schedule->school_id = Auth::user()->school_id;
                        $schedule->save();
                        $admin = Admin::find($request->input('admin-e-1'));
                        $subject = Subject::find($request->input('subject-e-1'));
                        $admin->subjects()->attach($subject);
                    }
                }
                elseif($date->isFriday())
                {
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '08:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-p-1');
                    $schedule->subject_id = $request->input('subject-p-1');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-p-1'));
                    $subject = Subject::find($request->input('subject-p-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '09:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-p-2');
                    $schedule->subject_id = $request->input('subject-p-2');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-p-1'));
                    $subject = Subject::find($request->input('subject-p-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '10:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-p-3');
                    $schedule->subject_id = $request->input('subject-p-3');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-p-1'));
                    $subject = Subject::find($request->input('subject-p-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '11:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-p-4');
                    $schedule->subject_id = $request->input('subject-p-4');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-p-1'));
                    $subject = Subject::find($request->input('subject-p-1'));
                    $admin->subjects()->attach($subject);
                    $schedule = new Schedule;
                    $schedule->date = $date;
                    $schedule->time = '12:00:00';
                    $schedule->classroom_id = $request->input('classroom_id');
                    $schedule->admin_id = $request->input('admin-p-5');
                    $schedule->subject_id = $request->input('subject-p-5');
                    $schedule->school_id = Auth::user()->school_id;
                    $schedule->save();
                    $admin = Admin::find($request->input('admin-p-1'));
                    $subject = Subject::find($request->input('subject-p-1'));
                    $admin->subjects()->attach($subject);
                    if($request->input('admin-p-6') != 'jo' || $request->input('subject-p-6') != 'jo')
                    {
                        $schedule = new Schedule;
                        $schedule->date = $date;
                        $schedule->time = '13:00:00';
                        $schedule->classroom_id = $request->input('classroom_id');
                        $schedule->admin_id = $request->input('admin-p-6');
                        $schedule->subject_id = $request->input('subject-p-6');
                        $schedule->school_id = Auth::user()->school_id;
                        $schedule->save();
                        $admin = Admin::find($request->input('admin-p-1'));
                        $subject = Subject::find($request->input('subject-p-1'));
                        $admin->subjects()->attach($subject);
                    }
                }
                elseif($date->isSaturday())
                {

                }
                else
                {

                }
                $date->add(1, 'day');
            }

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
        $schedule = Schedule::find($id);
        $classroom = Classroom::find($schedule->classroom_id);
        $subjects = Subject::where([['school_id','=',Auth::user()->school_id],['year','=',$classroom->year]])->get();
        $admins = Admin::where('school_id','=',Auth::user()->school_id)->get();
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-schedule', 'admin'))
            return view('admin.schedule.edit')->with('schedule',$schedule)->with('classroom',$classroom)->with('subjects',$subjects)->with('admins',$admins);
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
