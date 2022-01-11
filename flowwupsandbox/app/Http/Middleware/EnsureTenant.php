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

class EnsureTenant
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
        list($subdomain)=explode('.', $request->getHost(), 2);

        if(Auth::check()){
            $tenant = Team::where('team_slug','=', $subdomain)->first() ? : abort(404);
            $request->session()->put('tenant', $tenant);
            $request->session()->put('team', $tenant->name);
            \Session()->put('email', Auth::user()->email);

            if(Auth::user()->current_team_id ==null){
                return $next($request);
            }

            if(Auth::user()->current_team_id !=$tenant->id){
                
                $userteamid=Auth::user()->current_team_id;

                $userTeam = Team::find($userteamid) ? : abort(404);
                $request->session()->put('tenant', $userTeam);
                $request->session()->put('team', $userTeam->name);
              \Session()->put('email', Auth::user()->email);
               
                // $response=$request;

                // dd('Team id not equal');
                // $myrequest->setRouteResolver();
                // dd($myrequest);
                // $newrequest = new \Illuminate\Http\Request();
               
               
                // $response->headers->set('host','gill.localhost:8000');
                // $response->server->set('HTTP_HOST','gill.localhost:8000');
                // $response->server->set('HTTP_REFERER','http://gill.localhost:8000/login');
                // $response->session()->put('_previous','http://gill.localhost:8000/login');
               
               
                // dd($response);
                // $host=\config('app.hostname');
                // $tourl='http://gill.'.$host;
                
                
                // return Route::dispatchToRoute(\Illuminate\Http\Request::create($tourl));
                // return redirect($tourl)->withInput($response->toArray());
                return $next($request);
            }
        }else{
            $tenant = Team::where('team_slug','=', $subdomain)->first() ? : abort(404);
            $request->session()->put('tenant', $tenant);
        }

        return $next($request);
    }
}
