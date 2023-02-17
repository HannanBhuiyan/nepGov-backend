<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Facades\App\Helper\Helper;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::ADMIN;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }

    public function loginUser(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
            return redirect('/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    // function forgot_password_form(){
    //     return view('admin.auth.passwords.email');
    // }
   
}