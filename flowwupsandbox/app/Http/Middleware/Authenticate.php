<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Http\Controllers\UserMailController;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // list($ref)=explode('.',$request->headers->get('referer'),2);
        // list($host)=explode('.',$request->getHost(),2);
        // $host='http://'.$host;
        // $c=Auth::check();
        // // dd($ref .'---'.$host);
        // if (! $request->expectsJson()) {
        //     if($ref == $host){
        //         return route('login');
        //     }else{
        //         return route('loginemail');
        //     }
           

        //     // dd($request);
            return route('login');
        // }
    }
}
