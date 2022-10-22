<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use Auth;
use App\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->email ==  env('APP_SA'))
            $schools = School::all();
        else
            $schools = School::where('id','=',Auth::user()->school_id)->get();
        if(Auth::guard('admin')->user()->hasPermissionTo('view-school', 'admin')  || Auth::user()->email ==  env('APP_SA') )
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
        if(Auth::user()->email ==  env('APP_SA'))
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
        if(Auth::guard('admin')->user()->hasPermissionTo('create-school', 'admin') || Auth::user()->email ==  env('APP_SA')){
            $this->validate($request,[
                'Qyteti'=> 'required|string|min:2',
                'Emri'=> 'required|string|min:2',
                'Adresa'=> 'required|string|min:2',
                'Niveli'=> 'required',
                'Kodi'=> 'required|string|min:2',
                'email' => 'required|email|unique:admins',
                'password' => 'required|string|min:6|confirmed',
            ]);
            $school = new School;
            $school->city = $request->input('Qyteti');
            $school->name = $request->input('Emri');
            $school->address = $request->input('Adresa');
            $school->level = $request->input('Niveli');
            $school->code = $request->input('Kodi');
            $school->save();
            $admin = new Admin;
            $admin->fathers_name ='Drejtor';
            $admin->first_name = 'Drejtori';
            $admin->surname = 'Drejtori';
            $admin->address = $request->input('Adresa');
            $admin->birthday = '1990-10-10';
            $admin->city = $request->input('Qyteti');
            $admin->residence = $request->input('Qyteti');
            $admin->phone_nr = '049123456';
            $admin->grade = 'Drejtor';
            $admin->gender = 'M';
            $admin->photo = "Ska";
            $admin->school_id = $school->id;
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));
            $admin->save();
            $role = new Role;
            $role->name = 'Drejtor';
            $role->school_id = $school->id;
            $role->save();
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'view-user']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create-user']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'edit-user']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete-user']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'view-admin']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create-admin']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'edit-admin']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete-admin']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'view-school']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create-school']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'edit-school']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete-school']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'view-subject']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create-subject']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'edit-subject']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete-subject']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'view-schedule']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create-schedule']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'edit-schedule']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete-schedule']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'view-notice']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create-notice']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'edit-notice']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete-notice']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'view-grade']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create-grade']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'edit-grade']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete-grade']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'view-classroom']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create-classroom']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'edit-classroom']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete-classroom']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'view-role']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create-role']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'edit-role']));
            $role->givePermissionTo(Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete-role']));
            $admin->assignRole($role);
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
        if((Auth::guard('admin')->user()->hasPermissionTo('edit-school', 'admin') && Auth::user()->school_id == $id) || Auth::user()->email ==  env('APP_SA') )
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
        if((Auth::guard('admin')->user()->hasPermissionTo('edit-school', 'admin') && Auth::user()->school_id == $id) || Auth::user()->email ==  env('APP_SA') ){
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
        if(Auth::user()->email ==  env('APP_SA'))
        {
            $school = School::find($id);
            $school->delete();
            return redirect(route('admin.school.index'))->with('success',__('messages.school-delete'));
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }
}
