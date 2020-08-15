<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Grade;
use App\User;
use App\Admin;
use App\Classroom;
use App\Subject;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::where('school_id','=',Auth::user()->school_id)->paginate(20);
        if(Auth::guard('admin'))
            return view('admin.grade.index')->with('grades',$grades);
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
        $admins = Admin::where('school_id','=',Auth::user()->school_id)->get();
        $subjects = Subject::where('school_id','=',Auth::user()->school_id)->get();
        $classrooms = Classroom::where('school_id','=',Auth::user()->school_id)->get();
        if(Auth::guard('admin'))
            return view('admin.grade.create')->with('users',$users)->with('admins',$admins)->with('subjects',$subjects)->with('classrooms',$classrooms);
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
            'Nota'=> 'required|numeric',
            'Periudha'=> 'required|numeric',
        ]);
        $grade = new Grade;
        $grade->grade = $request->input('Nota');
        $grade->period = $request->input('Periudha');
        $grade->user_id = $request->input('Nxenesi');
        $grade->admin_id = $request->input('Profesori');
        $grade->classroom_id = $request->input('Klasa');
        $grade->subject_id = $request->input('Lenda');
        $grade->school_id = Auth::guard('admin')->user()->school_id;
        $grade->save();
        return redirect('/admin/grade')->with('success','U shtua nota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grade = Grade::find($id);
        if(Auth::guard('admin'))
            return view('admin.grade.show')->with('grade',$grade);
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
        $grade = Grade::find($id);
        $users = User::where('school_id','=',Auth::user()->school_id)->get();
        $admins = Admin::where('school_id','=',Auth::user()->school_id)->get();
        $subjects = Subject::where('school_id','=',Auth::user()->school_id)->get();
        $classrooms = Classroom::where('school_id','=',Auth::user()->school_id)->get();
        if(Auth::guard('admin'))
            return view('admin.grade.edit')->with('grade',$grade)->with('users',$users)->with('admins',$admins)->with('subjects',$subjects)->with('classrooms',$classrooms);
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
            'Nota'=> 'required|numeric',
            'Periudha'=> 'required|numeric',
        ]);
        $grade =  Grade::find($id);
        $grade->grade = $request->input('Nota');
        $grade->period = $request->input('Periudha');
        $grade->user_id = $request->input('Nxenesi');
        $grade->admin_id = $request->input('Profesori');
        $grade->classroom_id = $request->input('Klasa');
        $grade->subject_id = $request->input('Lenda');
        $grade->school_id = Auth::guard('admin')->user()->school_id;
        $grade->save();
        return redirect('/admin/grade')->with('success','U ndryshua nota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::find($id);
        $grade->delete();
        return redirect('/admin/grade')->with('success','U fshi nota');
    }
}
