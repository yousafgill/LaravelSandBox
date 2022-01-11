<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Events\TeamMemberAdded;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WelcomeEmailNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;

class UserRegistrationController extends Controller
{
    // use PasswordValidationRules;

    public $newteamid;
    public $domain;
    public $rt;
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
        //
        $input = $r->all();
        //  dd($input);
        $rt = Str::random(40);   //Generate a Random Token (Remember token)
       
         $usrdomain='';
         $d=explode('.', request()->getHost(), 2);
         $sd='';
         if(sizeof($d)==2){
             $sd=$d[0];
         }
         // dd($sd);
         if(isset($input['team_slug'])){
             $usrdomain = "http://".$input['team_slug'] . "." . \config('app.appdomain');    
         }else{
             $usrdomain = "http://".$sd . "." . \config('app.appdomain');    
         }
        //  Validator::make($input, [
        //      'name' => ['required', 'string', 'max:255'],
        //      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //      // 'teamname' =>['required','string','unique:teams,name'],
        //     //  'password' => $this->passwordRules(),
        //  ])->validate();
  
         $NewUser=DB::transaction(function () use ($input,$rt) {
             return tap(User::create([
                 'name' => $input['name'],
                 'email' => $input['email'],
                 'password' => Hash::make($input['password']),
                 'plan_mode' => 'Trial',
                 'trial_until' => now()->addDays(config('app.free_trial_days')),
             ]), 
             function (User $user) use ($input,$rt) {
                 // $this->createTeam($user, $input);
                     //## BEGIN EDIT - if there's an invite, attach them accordingly ##
                     if (isset($input['invite'])) {
                         if ($invitation = Invitation::where('code', $input['invite'])->first()) {
                             if ($team = $invitation->team) {
                                 $team->users()->attach(
                                     $user,
                                     ['role' => $invitation->role,
                                     // 'plan_mode' => 'Invite'
                                     ]
                                 );
                             $user->current_team_id = $team->id;
                             $user->plan_mode = 'Invite';
                             $user->remember_token=$rt;
                             $user->save();
                             TeamMemberAdded::dispatch($team, $user);
                             $invitation->delete();
                             }
                         }
                     }
                     else{
                        
                         if(isset($input['teamname'])){
                             $this->createTeam($user, $input,$rt);
                             $d=$input['team_slug'];
                         }else{
                            $user->remember_token=$rt;
                            $user->save();
                         }
                        
                     }
                 //## END EDIT ##
                
             });
            
         });
 
         $link1='1 : '.'<a href='. $usrdomain .'/dashboard/boards'.'> Click Here </a> to create your first feedback board' ;
         $data='';
         
 
         if(isset($input['team_slug'])){
             $data=[
                 'logintype' =>'company',
                 'name' => $NewUser->name,
                 'domain' =>  $usrdomain."/login",
                 'boardsurl' => $usrdomain .'/dashboard/boards',
                 // 'boardsurl' =>  $link1,
                 'createboard' => $usrdomain .'/dashboard/createboard',
                 'roadmapurl' => $usrdomain .'/roadmap',
                 'inviteurl' => $usrdomain .'/teams'."/".$NewUser->current_team_id
                     ];
         }else{
             $data=[
                 'logintype' =>'public',
                 'name' => $NewUser->name,
                 'domain' =>  $usrdomain."/login",
                 'boardsurl' => $usrdomain .'/dashboard/boards',
                 // 'boardsurl' =>  $link1,
                 'createboard' => $usrdomain .'/dashboard/createboard',
                 'roadmapurl' => $usrdomain .'/roadmap',
                 'inviteurl' => $usrdomain .'/teams'."/".$NewUser->current_team_id
                     ];
         }
         $NewUser->notify(new WelcomeEmailNotification($data));   
         // Notification::send($NewUser,)
        
        // 
        // $user->remember_token=$rt;
        // $user->save();
        //  return $NewUser;
        $credentials = $r->only('email', 'password');
        if (!Auth::guard('web')->attempt($credentials)) {
            //Not Authenticated
            return redirect()->route('loginemail.notfound');
        }
        $apphost=\config('app.appdomain');
        if(isset($input['team_slug'])){
            $sd=$input['team_slug'];
        }
        // 
        $tourl="http://".$sd .'.'. $apphost .'/login/password?email='.$r->email .'&rt='.$rt;
        return redirect($tourl);
    }


    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user, array $input,$rt)
    {
       $team= $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => $input['teamname'],
            'personal_team' => true,
            'team_slug' => $this->generateSlug( $input['team_slug'])
        ]));
        $this->newteamid= $team->id;
        $this->domain = $team->slug;
        $user->current_team_id = $team->id;
        $user->remember_token=$rt;
        $user->save();
        
        $sub=\DB::table('subscriptions')->insert([
            'team_id' => $team->id,
            'name' => 'Trial',
            'stripe_id' => 'Trial',
            'stripe_status' => 'Active',
            'stripe_plan' => 'Trial',
            'quantity' => 1,
            'trial_ends_at' => Carbon::now()->addDays(14),
            'ends_at' =>Carbon::now()->addDays(14)
        ]);
    }

    protected function generateSlug($string = null, $separator = "-")
    {
            if (is_null($string)) {
                return "";
            }

            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
            $slug = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
            $slug = strtolower($slug);

            return $slug;
    }

    public function redirectuser($domain){
       
        // return redirect('/dashboard');
        return redirect('/roadmap');
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
