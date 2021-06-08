<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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
        // dd($request->getHost());
       
        $validuri=array('/login','/register','/forgot-password','/roadmap','/logout');
        $d=explode('.', $request->getHost(), 2);
        if(sizeof($d)==1){
          if( !in_array($request->getRequestUri(),$validuri))
            {
              // $request->url = \config('app.url').'/welcome/';
              $request->server->set('REQUEST_URI','/welcome');
            }
            $request->session()->put('tenant', '');
            // dd($request);
            return $next($request);
        }
        else{

            // Extract the subdomain from URL.
            list($subdomain) = explode('.', $request->getHost(), 2);
            // Retrieve requested tenant's info from database.
            $tenant = Team::where('team_slug', $subdomain)->first() ? : abort(404);
            // dd($tenant." Sub Domain:".$subdomain);
            $request->session()->put('tenant', $tenant);
            // dd($request->getRequestUri());

            if(Auth::check()){
              if(Auth::user()->current_team_id !=$tenant->id){
                $userteam=Team::find(Auth::user()->current_team_id) ? :abort(404);
                $userdomain=$userteam->team_slug;
                $host=\config('app.hostname');
                if(!in_array($request->getRequestUri(),$validuri)){
                  // abort(403);
                  $tourl='http://'.$userdomain.'.'.$host;
                  return redirect($tourl);
                  // return redirect()->route('roadmap.public');
                }
              }
              else{
                // return redirect()->route('roadmap.public');
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