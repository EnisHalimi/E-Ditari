<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use Auth;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school = School::find(Auth::user()->school_id);
        if(Auth::guard('admin'))
            return view('admin.school.show')->with('school',$school);
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
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $school = School::find($id);
        if(Auth::guard('admin'))
            return view('admin.school.edit')->with('school',$school);
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
            'Qyteti'=> 'required|string|min:2',
            'Emri'=> 'required|string|min:2',
            'Adresa'=> 'required|string|min:2',
            'Niveli'=> 'required|string|min:2',
        ]);
        $school = School::find($id);
        $school->city = $request->input('Qyteti');
        $school->name = $request->input('Emri');
        $school->address = $request->input('Adresa');
        $school->level = $request->input('Niveli');
        $school->save();
        return redirect(route('admin.school.index'))->with('success','U ndryshua shkolla');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->back();
    }
}
