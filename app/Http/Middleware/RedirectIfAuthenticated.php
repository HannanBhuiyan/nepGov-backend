<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next, ...$guards)
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {

           
            
    //         if (Auth::guard($guard)->check()) {
    //             return redirect(RouteServiceProvider::HOME);
    //         }
        
    //         // if (Auth::guard($guard)->check()) {
    //         //     if(Auth::guard('admin')->check()){
    //         //         return redirect(RouteServiceProvider::HOME);
    //         //     }else{
    //         //         return redirect('/ok');
    //         //     }
    //         //     // return redirect(RouteServiceProvider::HOME);
    //         // }
    //     }

    //     return $next($request);
    // }


    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            if ($guard == "admin" && Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::ADMIN);
            }

            // if (Auth::guard($guard)->check()) {
            //     $bd_table = DB::table('model_has_roles')->where('model_id',Auth::id());
            //     if($bd_table){
            //         return redirect(RouteServiceProvider::ADMIN);
            //         // return 'ok';
            //     }
            //     // return redirect(RouteServiceProvider::HOME);
            // }
        }

        return $next($request);
    }
}
