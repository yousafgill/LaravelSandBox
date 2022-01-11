<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class UserMailController extends Controller
{
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('auth.loginemail');
    }

    public function loginpassword(){

        $rt=\Request()->input('rt');
        $em=\Request()->input('email');
        if($rt !=null){
            $user=User::where('email',$em)->first() ;
            if($user !=null){
                if(Auth::guard('web')->loginUsingId($user->id, true)){
                    if (auth()->check() && auth()->user()->plan_mode=="Trial" && auth()->user()->free_trial_days_left <= 0){
                        return \redirect('/billing');
                    }else{
                        return \redirect()->route('dashboard');
                    }
                    
                }
            }
        }
        
        return view('auth.loginpassword');
    }

    public function notfound(){
        return view('auth.notfound');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        //
        // Auth::loginUsingId(1);
        list($subdomain) = explode('.', $r->getHost(), 2);
        
        $tenant = Team::where('team_slug','=', $subdomain)->first() ? : abort(404);
        $user=User::where('email',$r->email)->first() ;
        if($user ==null){
            return \redirect()->route('loginemail.notfound');
        }
        if($user->current_team_id ==null){
            return \redirect()->route('roadmap.public');
        }
        $userteam=Team::find($user->current_team_id)->team_slug ? : abort(404);
        
        $ismydomain=$user->current_team_id == $tenant->id;
        $apphost=\config('app.appdomain');
        if($ismydomain){
            return \redirect('/login/password?email='.$r->email);
        } else{
            $tourl="http://".$userteam .'.'. $apphost .'/login/password?email='.$r->email;
            return \redirect($tourl);
        }
        // 
        // ddd($r->email .'---'. $r->getHost());
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
