<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class EnsureValidUri
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
      $old_login_attempt=Cookie::get('login_attempt');
      if($old_login_attempt !='YES') {
        Cookie::queue(cookie('login_attempt', 'NO', $minute = 10,$domain='.flowwup.com'));
      }

      $validuri=array('/login','/register','/forgot-password','/logout','/loginemail','/user/register','/roadmap','/stripe/webhook','/stripe/checkoutcompleted','/stripe/success','/stripe/checkout','/stripe/portal');
      $d=explode('.', $request->getHost(), 2);
      list($sd)=explode('.', $request->getHost(), 2);
      // dd($sd);
      
      if(sizeof($d)==1 ){
            if( !in_array($request->getRequestUri(),$validuri))
              {
                $host=\config('app.hostname');
                $tourl='http://admin.'.$host;
                return redirect($tourl)->withInput($request->all());
              }
              return $next($request);
              
      }
     
      if($sd=="www"){
        return $next($request);
      }
      if($sd=="admin"){
          $invaliduri=array('/roadmap');
          if( in_array($request->getRequestUri(),$invaliduri))
                {
                  $host=\config('app.hostname');
                  $tourl='http://admin.'.$host;
                  return redirect($tourl)->withInput($request->all());
                }
                return $next($request);
       
      }
      
        return $next($request);
    }
}
