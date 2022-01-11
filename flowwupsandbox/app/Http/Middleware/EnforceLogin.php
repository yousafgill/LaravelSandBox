<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
class EnforceLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $v=Cookie::get('login_attempt');
       
        $user_email=Cookie::get('email');
        $em=\Session::get('email');
        // dd($em);
        if($v != "YES" && $v !=null && $em !=null ){
                // Cookie::queue(cookie('login_attempt', 'YES', $minute = 10,$domain='.flowwup.com'));
                $user = User::where('email',$em)->first();
                // dd($user);
                if($user){
                    // Auth::guard('web')->loginUsingId($user->id); // login user automatically
                    Auth::guard('web')->login($user); // login user automatically
                    // Auth::login($user); // login user automatically
                    // return redirect('/dashboard');
                }else{
                    return "User not found!";
                }
        }
        return $next($request);
    }
}
