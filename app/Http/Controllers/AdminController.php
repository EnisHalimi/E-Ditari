<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Admin;
use Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::where('school_id','=',Auth::user()->school_id)->paginate(20);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-admin', 'admin'))
            return view('admin.admin.index')->with('admins',$admins);
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
        $roles = Role::where('school_id','=',Auth::guard('admin')->user()->school_id)->get();
        if(Auth::guard('admin')->user()->hasPermissionTo('create-admin', 'admin'))
            return view('admin.admin.create')->with('roles',$roles);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('create-admin', 'admin'))
        {
            $this->validate($request,[
                'Emri'=> 'required|min:2|string',
                'Emri_Prindit'=> 'required|min:2|string',
                'Mbiemri'=> 'required|min:2|string',
                'Adresa'=> 'required|min:2|string',
                'Qyteti'=> 'required|min:2|string',
                'Vendbanimi'=> 'required|min:2|string',
                'Nr_Telefonit'=> 'required|min:9|numeric',
                'Data_e_lindjes'=> 'required|date',
                'email' => 'required|email|unique:admins',
                'password' => 'required|string|min:6|confirmed',
                'Foto' =>'image|nullable|max:1999',
                'Roli'=> 'required',
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
            $admin = new Admin;
            $admin->fathers_name = $request->input('Emri_Prindit');
            $admin->first_name = $request->input('Emri');
            $admin->surname = $request->input('Mbiemri');
            $admin->address = $request->input('Adresa');
            $admin->birthday = $request->input('Data_e_lindjes');
            $admin->city = $request->input('Qyteti');
            $admin->residence = $request->input('Vendbanimi');
            $admin->phone_nr = $request->input('Nr_Telefonit');
            $admin->grade = $request->input('Roli');
            $admin->gender = $request->input('Gjinia');
            $admin->photo = $fileNametoStore;
            $admin->school_id = Auth::guard('admin')->user()->school_id;
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));
            $admin->save();
            $admin->assignRole($request->input('Roli'));
            return redirect(route('admin.admin.index'))->with('success',__('messages.admin-add'));
        }
        else
        {
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-admin', 'admin'))
            return view('admin.admin.show')->with('admin',$admin);
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
        $admin = Admin::findOrFail($id);
        $roles = Role::where('school_id','=',Auth::guard('admin')->user()->school_id)->get();
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-admin', 'admin'))
            return view('admin.admin.edit')->with('admin',$admin)->with('roles',$roles);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-admin', 'admin'))
        {
            $this->validate($request,[
                'Emri'=> 'required|min:2|string',
                'Emri_Prindit'=> 'required|min:2|string',
                'Mbiemri'=> 'required|min:2|string',
                'Adresa'=> 'required|min:2|string',
                'Qyteti'=> 'required|min:2|string',
                'Vendbanimi'=> 'required|min:2|string',
                'Nr_Telefonit'=> 'required|min:9|numeric',
                'Data_e_lindjes'=> 'required|date',
                'email' => 'required|email|unique:admins,email,'.$id,
                'Foto' =>'image|nullable|max:1999',
                'Roli'=> 'required',
            ]);
            $admin = Admin::find($id);
            if($request->hasFile('Foto'))
            {
                $fileNamewithExt = $request->file('Foto')->getClientOriginalName();
                $fileName = pathInfo($fileNamewithExt, PATHINFO_FILENAME);
                $extension = $request->file('Foto')->getClientOriginalExtension();
                $fileNametoStore = 'foto-'.Str::random(25).'.'.$extension;
                $request->file('Foto')->move(public_path('img'), $fileNametoStore);
                $admin->photo = $fileNametoStore;
            }
            $admin->first_name = $request->input('Emri');
            $admin->fathers_name = $request->input('Emri_Prindit');
            $admin->surname = $request->input('Mbiemri');
            $admin->address = $request->input('Adresa');
            $admin->birthday = $request->input('Data_e_lindjes');
            $admin->city = $request->input('Qyteti');
            $admin->residence = $request->input('Vendbanimi');
            $admin->phone_nr = $request->input('Nr_Telefonit');
            if($admin->grade != "Super Admin")
                $admin->grade =  $request->input('Roli');
            $admin->gender = $request->input('Gjinia');
            $admin->school_id = Auth::guard('admin')->user()->school_id;
            $admin->email = $request->input('email');
            $admin->save();
            $admin->syncRoles($request->input('Roli'));
            return redirect(route('admin.admin.index'))->with('success',__('messages.admin-edit'));
        }
        else{
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::guard('admin')->user()->hasPermissionTo('delete-admin', 'admin'))
        {
            $admin = Admin::find($id);
            if($admin->grades()->get()->count() > 0)
                $admin->grades()->delete();
            if($admin->subjects()->get()->count() > 0)
                $admin->subjects()->detach();
            if($admin->schedules()->get()->count() > 0)
                $admin->schedules()->delete();
            if($admin->classroom()->get()->count() > 0)
                $admin->classroom()->delete();
            $admin->delete();
            return redirect(route('admin.admin.index'))->with('success',__('messages.admin-delete'));
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }
}
