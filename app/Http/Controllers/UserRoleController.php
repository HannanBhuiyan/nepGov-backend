<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleController extends Controller
{
    function user_role_index(){
        return view('layouts.role.index',[
            'roles' => Role::all(),
            'users' => User::all(),
            'permissions' => Permission::all()
        ]);
    }
    function user_role_store(Request $request){

        $role = new Role;
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permission);

        return back()->with('success','Role Created Success' );
    }

    function user_role_update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->syncPermissions($request->permission);

        return back()->with('success','Role Assigned Success');
    }

    function user_role_delete($id){
        Role::findOrFail($id)->delete();
        return back()->with('success','Role Deleted Success' );
    }

    function user_role_assign(Request $request, $id){
        $role = Role::find($id);

        foreach ($request->user as $user_id) {
            $user = User::find($user_id);
            $user->assignRole($role);
        }
        return back();
    }

    function admin_create_index(){
        return view('admin.index',[
            'all_users' => User::all(),
            'users' => Admin::all(),
            'roles' => Role::all()
        ]);
    }   

    function user_admin_store(Request $request){
      
        $request->validate([      
            'email' => 'required|email|unique:admins',
            'role' => 'required'
        ],[
            'role.required'=>'Select Role',
            'email.required'=>'Select a User',
        ]);
        
        $selected_user = User::where('email', $request->email)->first();

        $user = Admin::create([
            'username' => $selected_user->username ?? '',
            'email'=> $request->email,
            'password' => $selected_user->password
        ]);

        foreach($request->role as $role){
            $role = Role::where('name', $role)->first();
            $user->assignRole($role);
        }

        return back()->with('success','User Assigned Success' );
    }

    function user_assign_update(Request $request, $id){
       
        $user = Admin::find($id);
       
        $user->syncRoles($request->role);

        return back()->with('success','Assign Updated Success' );
    }
    function user_admin_delete($id){
        Admin::findOrFail($id)->delete();

        return back()->with('success','User Deleted Success' );
    }


    
}
