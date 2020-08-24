<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;
use App\User;
use App\Classroom;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('school_id','=',Auth::user()->school_id)->where('isParent','=',null)->paginate(20);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-user', 'admin'))
            return view('admin.user.index')->with('users',$users);
        else
            return redirect(route('admin.user.index'))->with('error',__('messages.noauthorization'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $classroom_id = $request->classroom_id;
        if($classroom_id != null)
        {
            $classrooms = Classroom::where('id','=',$classroom_id)->get();
        }
        else
        $classrooms = Classroom::where('school_id','=',Auth::user()->school_id)->get();
        if(Auth::guard('admin')->user()->hasPermissionTo('create-user', 'admin'))
            return view('admin.user.create')->with('classrooms',$classrooms);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('create-user', 'admin')){
            $this->validate($request,[
                'Emri'=> 'required|min:2|string',
                'Emri_Prindit'=> 'required|min:2|string',
                'Mbiemri'=> 'required|min:2|string',
                'Adresa'=> 'required|min:2|string',
                'Qyteti'=> 'required|min:2|string',
                'Vendbanimi'=> 'required|min:2|string',
                'Nr_Telefonit'=> 'required|min:9|numeric',
                'Data_e_lindjes'=> 'required|date',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'Foto' =>'image|nullable|max:1999',
            ]);
            if($request->hasFile('Foto'))
            {
                $fileNamewithExt = $request->file('Foto')->getClientOriginalName();
                $fileName = pathInfo($fileNamewithExt, PATHINFO_FILENAME);
                $extension = $request->file('Foto')->getClientOriginalExtension();
                $fileNametoStore = 'foto-'.Str::random(25).'.'.$extension;
                $request->file('Foto')->move(public_path('img'), $fileNametoStore);
            }
            else
            {
                $fileNametoStore = 'no-image';
            }
            $user = new User;
            $user->first_name = $request->input('Emri');
            $user->fathers_name = $request->input('Emri_Prindit');
            $user->surname = $request->input('Mbiemri');
            $user->address = $request->input('Adresa');
            $user->birthday = $request->input('Data_e_lindjes');
            $user->city = $request->input('Qyteti');
            $user->residence = $request->input('Vendbanimi');
            $user->phone_nr = $request->input('Nr_Telefonit');
            if($request->input('Statusi') == null)
                $user->status = "Aktiv";
            else
                $user->status = $request->input('Statusi');
            $user->gender = $request->input('Gjinia');
            $user->photo = $fileNametoStore;
            $user->isParent = null;
            $user->classroom_id =  $request->input('Klasa');
            $user->school_id = Auth::guard('admin')->user()->school_id;
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return redirect(route('admin.classroom.index'))->with('success',__('messages.user-add'));
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
        $user = User::findOrFail($id);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-user', 'admin'))
            return view('admin.user.show')->with('user',$user);
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
        $user = User::findOrFail($id);
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-user', 'admin'))
            return view('admin.user.edit')->with('classrooms',$classrooms)->with('user',$user);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-user', 'admin')){
            $this->validate($request,[
                'Emri'=> 'required|min:2|string',
                'Emri_Prindit'=> 'required|min:2|string',
                'Mbiemri'=> 'required|min:2|string',
                'Adresa'=> 'required|min:2|string',
                'Qyteti'=> 'required|min:2|string',
                'Vendbanimi'=> 'required|min:2|string',
                'Nr_Telefonit'=> 'required|min:9|numeric',
                'Data_e_lindjes'=> 'required|date',
                'email' => 'required|email|unique:users,email,'.$id,
                'Foto' =>'image|nullable|max:1999',
                'password' => 'confirmed',
            ]);
            $user = User::find($id);
            if($request->hasFile('Foto'))
            {
                $fileNamewithExt = $request->file('Foto')->getClientOriginalName();
                $fileName = pathInfo($fileNamewithExt, PATHINFO_FILENAME);
                $extension = $request->file('Foto')->getClientOriginalExtension();
                $fileNametoStore = 'foto-'.Str::random(25).'.'.$extension;
                $request->file('Foto')->move(public_path('img'), $fileNametoStore);
                $user->photo = $fileNametoStore;
            }
             if($request->input('Statusi') != null)
                $user->status = $request->input('Statusi');
            $user->status = $request->input('Statusi');
            $user->first_name = $request->input('Emri');
            $user->fathers_name = $request->input('Emri_Prindit');
            $user->surname = $request->input('Mbiemri');
            $user->address = $request->input('Adresa');
            $user->birthday = $request->input('Data_e_lindjes');
            $user->city = $request->input('Qyteti');
            $user->residence = $request->input('Vendbanimi');
            $user->phone_nr = $request->input('Nr_Telefonit');
            $user->gender = $request->input('Gjinia');
            $user->classroom_id =  $request->input('Klasa');
            $user->school_id = Auth::guard('admin')->user()->school_id;
            $user->email = $request->input('email');
            if($request->input('password') > 0)
            {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();
            return redirect(route('admin.classroom.index'))->with('success',__('messages.user-edit'));
        }
        else
            return redirect(route('admin.home'))->with('errors',__('messages.noauthorization'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::guard('admin')->user()->hasPermissionTo('delete-user', 'admin')){
            $user = User::find($id);
            $user->grades()->delete();
            $user->notices()->delete();
            $user->delete();
            return redirect(route('admin.classroom.index'))->with('success',__('messages.user-delete'));
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }
}
