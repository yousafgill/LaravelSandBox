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
use Illuminate\Support\Str;

class PublicLoginController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        list($subdomain) = explode('.', $r->getHost(), 2);


        $credentials = $r->only('email', 'password');
        // dd($credentials);
        if (!Auth::guard('web')->attempt($credentials)) {
            //Not Authenticated
            return redirect()->route('loginemail.notfound');
        }
        else{
            //Authenticated
            $tenant = Team::where('team_slug','=', $subdomain)->first() ? : abort(404);
            $user=Auth::user();
            
            if($user->current_team_id ==null){
                return redirect()->route('roadmap.public');
            }

            if($user->current_team_id != null){
                if($tenant->id == $user->current_team_id){
                    $r->session()->put('tenant', $tenant);
                    return redirect()->route('dashboard');
                }else{
                    $apphost=\config('app.appdomain');
                    $userteam=Team::find($user->current_team_id)->team_slug;
                    $r->session()->put('tenant', $userteam);
                    $rt= Str::random(40);
                    $user->remember_token=$rt;
                    $user->save();
                    $tourl="http://".$userteam .'.'. $apphost .'/login/password?email='.$r->email .'&rt='.$rt;
                    return \redirect($tourl);

                }
            }
            // dd($user->current_team_id);
            return redirect()->route('roadmap.public');
            // return redirect()->route('roadmap.public');
        }
       
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
