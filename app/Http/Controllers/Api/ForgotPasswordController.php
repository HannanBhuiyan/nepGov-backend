<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $rules = array(
            'email' => 'required|email|exists:users',
        );
        $valiodator = Validator::make($request->all(), $rules);

        if($valiodator->fails()){
            return response()->json($valiodator->errors(),401);
        }else{
            $status = Password::sendResetLink(
                $request->only('email')
            );
    
            if ($status == Password::RESET_LINK_SENT) {
                return [
                    'status' => __($status)
                ];
            }
            
        }
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            
            return response([
                'status' => 200,
                'message'=> 'Password reset successfully'
            ]);
        }

        return response()->json([
            'status' => 401,
            'message'=> __($status)
        ]);

    }

}
