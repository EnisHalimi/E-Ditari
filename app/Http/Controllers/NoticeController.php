<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use App\User;
use App\Schedule;
use Auth;
use App\Classroom;
use Carbon\Carbon;
use Redirect,Response;

use function Symfony\Component\VarDumper\Dumper\esc;

class NoticeController extends Controller
{

    public function getNotices()
    {
        $notices = Notice::where('user_id','=',Auth::user()->id)->get();
        $schedules = Schedule::where('classroom_id','=',Auth::user()->classroom_id)->get();
        $data[] = [];
        foreach($notices as $notice)
        {
            $data[] = array(
                'title' => $notice->description.' - '.$notice->schedule->subject->name.' | '.$notice->schedule->time,
                'start' => $notice->schedule->date,
                'end' => $notice->schedule->date,
                'backgroundColor' => '#e74a3b',
                'borderColor' =>  '$000000'
            );
        }
        foreach($schedules as $schedule)
        {
            $data[] = array(
                'title' => $schedule->subject->name.' | '.$schedule->time,
                'start' => $schedule->date,
                'end' => $schedule->date,
                'backgroundColor' => '#1cc88a',
                'borderColor' =>  '$3a3b45'
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
        $notices = Notice::where('school_id','=',Auth::user()->school_id)->paginate(20);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-notice', 'admin'))
            return view('admin.notice.index')->with('notices',$notices);
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
        $classroom_id = $request->classroom_id;
        $today = Carbon::now();
        if($classroom_id != null)
        {
            $schedules = Schedule::where([
                ['school_id','=',Auth::user()->school_id],
                ['classroom_id','=',$classroom_id],
                ['date','=',$today->toDateString()],
                ['admin_id','=',Auth::user()->id]
            ])->get();
            $classroom = Classroom::find($classroom_id);
            $users = $classroom->students;
        }
        else
        {
            $schedules = Schedule::where('school_id','=',Auth::user()->school_id)->get();
            $users = User::where('school_id','=',Auth::user()->school_id)->get();
        }

        if(Auth::guard('admin')->user()->hasPermissionTo('create-notice', 'admin'))
            return view('admin.notice.create')->with('schedules',$schedules)->with('users',$users)->with('munges',$request->munges);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('view-notice', 'admin')){
        $this->validate($request,[
            'Nxenesi'=> 'required',
            'Orari'=> 'required',
        ]);
        $notice = new Notice;
		if($request->input('Pershkrimi') == null && $request->input('Arsyeshme') == 0)
			$notice->description = "Veretje";
		else if($request->input('Pershkrimi') == null && $request->input('Arsyeshme') == 1)
			$notice->description = "Mungese";
		else if($request->input('Pershkrimi') == null && $request->input('Arsyeshme') == 2)
			$notice->description = "Mungese";
		else
			$notice->description = $request->input('Pershkrimi');
		$notice->user_id = $request->input('Nxenesi');
        $notice->arsyeshme = $request->input('Arsyeshme');
        $notice->schedule_id = $request->input('Orari');
        $notice->school_id = Auth::user()->school_id;
        $notice->save();
        return redirect()->back()->with('success',__('messages.notice-add'));
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
    public function show($id)
    {
        $notice = Notice::find($id);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-notice', 'admin'))
            return view('admin.notice.show')->with('notice',$notice);
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
        $notice = Notice::find($id);
        $today = Carbon::now();
        $schedules = Schedule::where([
            ['school_id','=',Auth::user()->school_id],
            ['classroom_id','=',$notice->schedule->classroom_id],
            ['date','=',$today->toDateString()],
            ['admin_id','=',Auth::user()->id]
        ])->get();
        $classroom = Classroom::find($notice->schedule->classroom_id);
        $users = $classroom->students;
		if($notice->arsyeshme == 0)
			$munges = false;
		else
			$munges = true;
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-notice', 'admin') &&  Auth::user()->id == $notice->schedule->admin_id)
            return view('admin.notice.edit')->with('schedules',$schedules)->with('users',$users)->with('notice',$notice)->with('munges',$munges);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-notice', 'admin')){
        $this->validate($request,[
            'Nxenesi'=> 'required',
            'Orari'=> 'required',
        ]);
        $notice =  Notice::find($id);
        $notice->description = $request->input('Pershkrimi');
        $notice->user_id = $request->input('Nxenesi');
        $notice->arsyeshme = $request->input('Arsyeshme');
        $notice->schedule_id = $request->input('Orari');
        $notice->school_id = Auth::user()->school_id;
        $notice->save();
        return redirect()->back()->with('success',__('messages.notice-edit'));
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
        $notice = Notice::find($id);
        $classroom = Classroom::find($notice->schedule->classroom_id);
        if(Auth::guard('admin')->user()->hasPermissionTo('delete-notice', 'admin') &&  Auth::user()->id == $notice->schedule->admin_id){
            $notice->delete();
            return redirect()->back()->with('success',__('messages.notice-delete'));
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }
}
