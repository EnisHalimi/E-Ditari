<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notice;
use App\User;
use App\Schedule;
use Auth;
use Mockery\Matcher\Not;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::where('school_id','=',Auth::user()->school_id)->paginate(20);
        if(Auth::guard('admin'))
            return view('admin.notice.index')->with('notices',$notices);
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
        $users = User::where('school_id','=',Auth::user()->school_id)->get();
        $schedules = Schedule::where('school_id','=',Auth::user()->school_id)->get();
        if(Auth::guard('admin'))
            return view('admin.notice.create')->with('schedules',$schedules)->with('users',$users);
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
            'Pershkrimi'=> 'required',
        ]);
        $notice = new Notice;
        $notice->description = $request->input('Pershkrimi');
        $notice->user_id = $request->input('Nxenesi');
        $notice->schedule_id = $request->input('Orari');
        $notice->school_id = Auth::user()->school_id;
        $notice->save();
        return redirect('/admin/notice')->with('success','U shtua mungesa');
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
        if(Auth::guard('admin'))
            return view('admin.notice.show')->with('notice',$notice);
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
        $users = User::where('school_id','=',Auth::user()->school_id)->get();
        $schedules = Schedule::where('school_id','=',Auth::user()->school_id)->get();
        $notice = Notice::find($id);
        if(Auth::guard('admin'))
            return view('admin.notice.edit')->with('schedules',$schedules)->with('users',$users)->with('notice',$notice);
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
            'Pershkrimi'=> 'required',
        ]);
        $notice =  Notice::find($id);
        $notice->description = $request->input('Pershkrimi');
        $notice->user_id = $request->input('Nxenesi');
        $notice->schedule_id = $request->input('Orari');
        $notice->school_id = Auth::user()->school_id;
        $notice->save();
        return redirect('/admin/notice')->with('success','U ndryshua mungesa');
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
        $notice->delete();
        return redirect('/admin/notice')->with('success','U fshi mungesa');
    }
}
