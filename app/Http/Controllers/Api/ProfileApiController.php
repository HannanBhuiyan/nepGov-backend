<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ProfileApiController extends Controller
{
    public function profile_index_api()
    {
        $user = User::findOrFail(Auth::id());
        return response()->json($user);
    }

    public function update_image_api(Request $request)
    {
        if($request->hasFile('image'))
        {
            $image    = $request->file('image');
            $ext      = uniqid() . '.' . $image->getClientOriginalExtension();
            $location = 'backend/assets/uploads/profile/';
            $filename = $location.$ext;
            $image->move( $location, $ext);
        }
        
        User::findOrFail(Auth::id())->update([
            'image' => $filename,
        ]);

        return response()->json(['status'=>200,'success'=>'Profile Image update success']);
    }

    public function edit_profile_api(Request $request)
    {
        // return 'ok';
        // return Auth::id();
        $user = User::findOrFail(Auth::id());

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        // $user->email = $request->email;
        $user->street = $request->street;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->website = $request->website;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();
        return response()->json(['status'=>200,'success'=>'Profile update success']);
    }

    public function profile_password_change_api(Request $request)
    {
        $rules=array(
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        );
        $valiodator = Validator::make($request->all(), $rules);
        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            if(Hash::check($request->current_password, Auth::user()->password)){
                if($request->new_password == $request->confirm_password){
                    User::findOrFail(Auth::id())->update([
                        'password' => Hash::make($request->new_password),
                    ]);

                    if ($token = $request->bearerToken()) {
                        $model = Sanctum::$personalAccessTokenModel;
                        $accessToken = $model::findToken($token);
                        $accessToken->delete();

                        // return response()->json(['success' => 'token mismatched']);
                    }
                    Auth::guard('web')->logout();

                    return response()->json(['status'=>200,'success'=>'Password Change Successful - Login Again Please']);
                }
                else {
                    return response()->json(['status'=>400,'fail'=>'New password and confirm password does not match']);
                }
            }
            else {
               return response()->json(['status'=>400,'fail'=>'Old password and current password does not match !']);
            }
        }
    }
}
