<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::where('school_id','=',Auth::user()->school_id)->paginate(20);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-subject', 'admin'))
            return view('admin.subject.index')->with('subjects',$subjects);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('create-subject', 'admin'))
            return view('admin.subject.create');
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
        if(Auth::guard('admin')->user()->hasPermissionTo('create-subject', 'admin')){
            $this->validate($request,[
                'Viti'=> 'required|numeric',
                'Emri'=> 'required|string|min:2',
            ]);
            $subject = new Subject;
            $subject->year = $request->input('Viti');
            $subject->name = $request->input('Emri');
            $subject->school_id = Auth::guard('admin')->user()->school_id;
            $subject->save();
            return redirect()->back()->with('success',__('messages.subject-add'));
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
        $subject = Subject::find($id);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-subject', 'admin'))
            return view('admin.subject.show')->with('subject',$subject);
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
        $subject = Subject::find($id);
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-subject', 'admin'))
            return view('admin.subject.edit')->with('subject',$subject);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-subject', 'admin'))
        {
            $this->validate($request,[
                'Viti'=> 'required|numeric',
                'Emri'=> 'required|string|min:2',
            ]);
            $subject = Subject::find($id);
            $subject->year = $request->input('Viti');
            $subject->name = $request->input('Emri');
            $subject->save();
            return redirect()->back()->with('success',__('messages.subject-edit'));
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
        if(Auth::guard('admin')->user()->hasPermissionTo('delete-subject', 'admin')){
            $subject = Subject::find($id);
            $subject->delete();
            return redirect()->back()->with('success',__('messages.subject-delete'));
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }
}
