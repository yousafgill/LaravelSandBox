<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\Team;

class CheckTenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Extract the subdomain from URL.
        list($subdomain) = explode('.', $request->getHost(), 2);
        // Retrieve requested tenant's info from database.
        //$tenant = Team::where('team_slug', $subdomain)->firstOrFail();
        $tenant = Team::where('team_slug', $subdomain)->first();
        //dd($tenant." Sub Domain:".$subdomain);
        if ($tenant != null){
          //dd($tenant);
          // Store the tenant info into session.
          $request->session()->put('tenant', $tenant);
        } else {
          //Slug not found in the DB so redirect them to the homepage
          //dd('Nothing found Bruh!');
          //dd(\config('app.url'));

          if ($request->url() != \config('app.url')){
              //return redirect(\config('app.url'));
              //If $subdomain then show a "Company not found page"
          }
          //dd($request->url());
        }
        //dd($tenant);
        // Store the tenant info into session.
        //$request->session()->put('tenant', $tenant);

        return $next($request);
    }
}
