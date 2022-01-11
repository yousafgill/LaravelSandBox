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

class CheckTenant
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
      $old_cookie_value=Cookie::get('flowwup_session');
        $validuri=array('/login','/register','/forgot-password','/roadmap','/logout','/dashboard');
        $d=explode('.', $request->getHost(), 2);
        // dd(sizeof($d));
        if(sizeof($d)==1){
          if( !in_array($request->getRequestUri(),$validuri))
            {
              // $request->url = \config('app.url').'/welcome/';
              $request->server->set('REQUEST_URI','/welcome');
            }
            // $request->session()->put('tenant', 'gill');
            return $next($request);
            
        }
        else{
          
            // Extract the subdomain from URL.
            list($subdomain) = explode('.', $request->getHost(), 2);
            // Retrieve requested tenant's info from database.
            $tenant = Team::where('team_slug','=', $subdomain)->first() ? : abort(404);
            // dd($tenant." Sub Domain:".$subdomain);
            $request->session()->put('tenant', $tenant);
            // dd($request->getRequestUri());
          
            if(Auth::check()){

              if(Auth::user()->current_team_id !=$tenant->id){
               
                $userteam='';
                $userdomain='';
                if(isset($input['team_slug']))
                {
                  $userteam=Team::find(Auth::user()->current_team_id) ? :abort(404);

                  $userdomain=$userteam->team_slug;
                }
                else{
                  // dd($request);
                  return $next($request);
                }
               
                
                $host=\config('app.hostname');
                if(!in_array($request->getRequestUri(),$validuri)){
                  
                  $request->session()->put('tenant', $userdomain);
                  
                  $tourl='http://'.$userdomain.'.'.$host;
                  $request->flash();
                  // dd($request);
                  // return $next($request);
                  // $v=Cookie::get('flowwup_session');
                  Cookie::queue(cookie('flowwup_session', $old_cookie_value, $minute = 10,$domain=$userdomain.'.'.$host));

                  // dd($v);
                
                  $user=Auth::user();
                  
                  // Auth::guard()->login($user);
                  return redirect($tourl)->withInput($request->all());
                }
              }
              else{
              
                //return redirect()->route('roadmap.public');
                $request->session()->put('tenant', $tenant);
                
                return $next($request);
              }
            }
            else{
              if(!in_array($request->getRequestUri(),$validuri))
              {
                return $next($request);
              }
            }
        }
        return $next($request);
    }
}