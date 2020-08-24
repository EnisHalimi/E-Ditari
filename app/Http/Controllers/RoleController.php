<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('school_id','=',Auth::guard('admin')->user()->school_id)->paginate(20);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-role', 'admin'))
            return view('admin.role.index')->with('roles',$roles);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('create-role', 'admin'))
            return view('admin.role.create');
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
        if(Auth::guard('admin')->user()->hasPermissionTo('create-role', 'admin')){
            $this->validate($request,[
                'Emri'=> 'required|min:3|string',
            ]);
            $role = new Role;
            $role->name = $request->input('Emri');
            $role->school_id = Auth::guard('admin')->user()->school_id;
            $role->save();
            $role->syncPermissions($request->input('permission'));
            return redirect(route('admin.role.index'))->with('success',__('messages.role-add'));
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
        $role = Role::find($id);
        if(Auth::guard('admin')->user()->hasPermissionTo('view-role', 'admin'))
            return view('admin.role.show')->with('role',$role);
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
        $role = Role::find($id);
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-role', 'admin'))
            return view('admin.role.edit')->with('role',$role);
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
        if(Auth::guard('admin')->user()->hasPermissionTo('edit-role', 'admin')){
            $this->validate($request,[
                'Emri'=> 'required|min:3|string',
            ]);
            $role =  Role::find($id);
            $role->name = $request->input('Emri');
            $role->school_id = Auth::guard('admin')->user()->school_id;
            $role->save();
            $permissions = $request->input('permission');
            $role->syncPermissions($request->input('permission'));
            return redirect(route('admin.role.index'))->with('success',__('messages.role-edit'));
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
        if(Auth::guard('admin')->user()->hasPermissionTo('delete-role', 'admin')){
            $role =  Role::find($id);
            $role->permissions()->detach();
            $role->delete();
            return redirect(route('admin.role.index'))->with('success',__('messages.role-delete'));
        }
        else
            return redirect(route('admin.home'))->with('error',__('messages.noauthorization'));
    }
}
