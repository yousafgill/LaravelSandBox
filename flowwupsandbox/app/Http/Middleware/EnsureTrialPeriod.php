<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTrialPeriod
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
        
        $response=$next($request);
        $ignoreuri=array('/billing','/stripe/checkout');
        if(!in_array($request->getRequestUri(),$ignoreuri)){
            if (auth()->check() && auth()->user()->plan_mode=="Trial" && auth()->user()->free_trial_days_left <= 0){
                // dd($request->input('email'));
                return \redirect('/billing');
            }
        }
        return $response;
    }
}
