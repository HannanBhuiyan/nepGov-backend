<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    public function profile_index()
    {
        return view('layouts.backend.profile.profile-index');
    }

    public function update_image(Request $request)
    {
        $data = Admin::findOrFail(Auth::id());
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imag_ext = $image->getClientOriginalExtension();
     
            $hexCode = hexdec(uniqid());
            $full_name = $hexCode.'.'.$imag_ext;
            $upload_location = 'backend/assets/uploads/profile/';
            $last_image = $upload_location.$full_name;
            Image::make($image)->resize(300, 300)->save($last_image);

            $data->profile_photo = $last_image;
        }
        // $image = $request->file('image');

        // if($image){
        //     $imag_ext = $image->getClientOriginalExtension();
        //     $hexCode = hexdec(uniqid());
        //     $full_name = $hexCode.'.'.$imag_ext;
        //     $upload_location = 'backend/assets/uploads/profile/';
        //     $last_image = $upload_location.$full_name;
        //     Image::make($image)->resize(300, 300)->save($last_image);
        // }
        
        $data->save();

        return redirect()->back()->with('success', 'Profile Image update success');
    }

    public function profile_password_change(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ],[
            'current_password.required' => 'Old Password is required !',
            'new_password.required' => 'New Password is required !',
            'confirm_password.required' => 'Confirm Password is required !',
        ]);

        if(Hash::check($request->current_password, Auth::user()->password)){

            if($request->new_password == $request->confirm_password){

                Admin::findOrFail(Auth::id())->update([
                    'password' => Hash::make($request->new_password),
                ]);

                Auth::logout();
                return redirect()->route('adminLogin');
            }
            else {
                return redirect()->back()->with('fail', 'New password and confirm password does not match');
            }
        }
        else {
           return redirect()->back()->with('fail', 'Old password and current password does not match !');
        }
    }

    public function edit_profile(Request $request)
    {
        Admin::findOrFail(Auth::id())->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);
        return redirect()->back()->with('success', 'Profile update succes');
    }
}

