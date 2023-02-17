<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
      {
         return view('admin.auth.passwords.email');
      }

      public function submitForgetPasswordForm(Request $request)
      {
        // return 'ok';
        // return $request;
          $request->validate([
              'email' => 'required|email|exists:admins',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }

      public function showResetPasswordForm($token) { 
        return view('admin.auth.passwords.reset', ['token' => $token]);
     }

     public function submitResetPasswordForm(Request $request)
     {
         $request->validate([
             'email' => 'required|email|exists:admins',
             'password' => 'required|string|min:6|confirmed',
             'password_confirmation' => 'required'
         ]);
 
         $updatePassword = DB::table('password_resets')
              ->where([
                'email' => $request->email, 
                'token' => $request->token
              ])
              ->first();
 
         if(!$updatePassword){
             return back()->withInput()->with('error', 'Invalid token!');
         }
 
         $user = Admin::where('email', $request->email)
                     ->update(['password' => Hash::make($request->password)]);

          Auth::guard('web')->logout();

         DB::table('password_resets')->where(['email'=> $request->email])->delete();
 
         return redirect('/adminLogin')->with('message', 'Your password has been changed!');
     }

    // use SendsPasswordResetEmails;
}
