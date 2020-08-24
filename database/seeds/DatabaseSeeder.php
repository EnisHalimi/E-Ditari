<?php

use App\Classroom;
use App\School;
use App\Admin;
use App\User;
use App\Subject;
use App\Schedule;
use App\Notice;
use App\Grade;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(School::class, 3)->create()->each(function ($school)
        {

            $role = factory(Role::class)->create(['school_id'=>$school->id]);
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
            $admin = factory(Admin::class)->create(['school_id'=>$school->id]);
            $admin->assignRole($role);
            $classroom = factory(Classroom::class)->create(['school_id'=>$school->id,'admin_id'=>$admin->id]);
            $user = factory(User::class, 5)->create(['school_id'=>$school->id,'classroom_id'=>$classroom->id]);


        });
    }
}
