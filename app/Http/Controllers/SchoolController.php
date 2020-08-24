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
        $schools = School::all();
        if(Auth::guard('admin')->user()->hasPermissionTo('view-school', 'admin'))
            return view('admin.school.index')->with('schools',$schools);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('create-school', 'admin'))
            return view('admin.school.create');
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
        if(Auth::guard('admin')->user()->hasPermissionTo('create-school', 'admin')){
            $this->validate($request,[
                'Qyteti'=> 'required|string|min:2',
                'Emri'=> 'required|string|min:2',
                'Adresa'=> 'required|string|min:2',
                'Niveli'=> 'required',
                'Kodi'=> 'required|string|min:2',
            ]);
            $school = new School;
            $school->city = $request->input('Qyteti');
            $school->name = $request->input('Emri');
            $school->address = $request->input('Adresa');
            $school->level = $request->input('Niveli');
            $school->code = $request->input('Kodi');
            $school->save();
            return redirect(route('admin.school.index'))->with('success',__('messages.school-add'));
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
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-school', 'admin'))
            return view('admin.school.edit')->with('school',$school);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-school', 'admin')){
            $this->validate($request,[
                'Qyteti'=> 'required|string|min:2',
                'Emri'=> 'required|string|min:2',
                'Adresa'=> 'required|string|min:2',
                'Niveli'=> 'required|string|min:2',
                'Kodi'=> 'required|string|min:2',
            ]);
            $school = School::find($id);
            $school->city = $request->input('Qyteti');
            $school->name = $request->input('Emri');
            $school->address = $request->input('Adresa');
            $school->level = $request->input('Niveli');
            $school->code = $request->input('Kodi');
            $school->save();
            return redirect(route('admin.school.index'))->with('success',__('messages.school-edit'));
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
        if(Auth::guard('admin')->user()->hasPermissionTo('delete-school', 'admin'))
        {
            $school = School::find($id);
            $school->delete();
            return redirect(route('admin.school.index'))->with('success',__('messages.school-delete'));
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }
}
