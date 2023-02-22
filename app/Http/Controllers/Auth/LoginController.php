<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Website;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    public function EmailVerificationSent($email){
        $varify = Website::find(1)->need_varification;
        if($varify == 'yes'){
            $token = random_int(100000, 999999);
            $exists = DB::table('verify_needs')->where('email',$email)->exists();
                if(!$exists){
                    DB::table('verify_needs')->insert([
                        'email' => $email, 
                        'token' => $token, 
                        'created_at' => Carbon::now()
                    ]);
                }else{
                    DB::table('verify_needs')->where('email',$email)->update([
                        'token' => $token, 
                        'updated_at' => Carbon::now()
                    ]);
                }
                
                Mail::send('email.verifyRegistration', ['token' => $token], function($message) use($email){
                    $message->to($email);
                    $message->subject('Verify your email address');
                });

            return response()->json([
                "status"=>200,
                "verify_token"=>$token,
                "message"=> "Verify your email address"
            ]);
        }
    }


    public $username;
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function createUser(Request $request)
    {
        // return 'ok';
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $varify = Website::find(1)->need_varification;

            if($varify == 'yes'){
                $user = User::create([
                    'email' => $request->email,
                    "token_verify"=>1,
                    'password' => Hash::make($request->password),
                    'country' => $request->country,
                    // 'city' => $request->city,
                    'date_of_birth' => $request->date_of_birth,
                    'postcode' => $request->postcode,
                ]);
                DB::table('verify_needs')->where('email',$request->email)->delete();
            }else{
                $user = User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'country' => $request->country,
                    // 'city' => $request->city,
                    'date_of_birth' => $request->date_of_birth,
                    'postcode' => $request->postcode,
                    "token_verify"=>0,
                ]);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
            
            // Auth::guard('web')->logout();

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function loginUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
         
        if(User::where('email', $request->email)->exists()) {
            
            $pass = Hash::check($request->password, $user->password);
 
            if($pass){
                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Credentials does not match',
                ]);
            } 
        }
        else {
           
            return response()->json([
                'status' => false,
                'message' => 'Credentials does not match',
            ]);
        }  

    }

    public function logout(Request $request) {
        if ($token = $request->bearerToken()) {
            $model = Sanctum::$personalAccessTokenModel;
            $accessToken = $model::findToken($token);
            $accessToken->delete();

            // return response()->json(['success' => 'token mismatched']);
        }
        // auth()->user()->currentAccessToken()->delete();
        Auth::guard('web')->logout();
        return response()->json(['success'=> 'signed out success']);
    }


}
