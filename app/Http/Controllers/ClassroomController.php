<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use Auth;
use App\Admin;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::where('school_id','=',Auth::user()->school_id)->paginate(20);
        if(Auth::guard('admin'))
            return view('admin.classroom.index')->with('classrooms',$classrooms);
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
        $admins = Admin::where('school_id','=',Auth::user()->school_id)->get();
        if(Auth::guard('admin'))
            return view('admin.classroom.create')->with('admins',$admins);
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
            'Klasa'=> 'required|numeric',
            'Paralelja'=> 'required|numeric',
        ]);
        $classroom = new Classroom;
        $classroom->year = $request->input('Klasa');
        $classroom->parallel = $request->input('Paralelja');
        $classroom->admin_id = $request->input('Kujdestari');
        $classroom->school_id = Auth::guard('admin')->user()->school_id;
        $classroom->save();
        return redirect('/admin/classroom')->with('success','U shtua klasa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom = Classroom::find($id);
        if(Auth::guard('admin'))
            return view('admin.classroom.show')->with('classroom',$classroom);
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
        $classroom = Classroom::find($id);
        $admins = Admin::where('school_id','=',Auth::user()->school_id)->get();
        if(Auth::guard('admin'))
            return view('admin.classroom.edit')->with('classroom',$classroom)->with('admins',$admins);
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
            'Klasa'=> 'required|numeric',
            'Paralelja'=> 'required|numeric',
        ]);
        $classroom =  Classroom::find($id);
        $classroom->year = $request->input('Klasa');
        $classroom->parallel = $request->input('Paralelja');
        $classroom->admin_id = $request->input('Kujdestari');
        $classroom->school_id = Auth::guard('admin')->user()->school_id;
        $classroom->save();
        return redirect('/admin/classroom')->with('success','U ndryshua klasa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom =  Classroom::find($id);
        if($classroom->users->count() > 0)
            return redirect('/admin/classroom')->with('error','Klasa ka ende nxenes nuk mund te shlyhet');
        $classroom->delete();
        return redirect('/admin/classroom')->with('success','U fshi klasa');
    }
}
