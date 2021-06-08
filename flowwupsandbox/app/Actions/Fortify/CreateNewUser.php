<?php

namespace App\Actions\Fortify;

use App\Models\Invitation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Events\TeamMemberAdded;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public $newteamid;
    public $domain;
    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'teamname' =>['required','string','unique:teams,name'],
            'password' => $this->passwordRules(),
        ])->validate();

        $NewUser=DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'plan_mode' => 'Trial',
                'trial_until' => now()->addDays(config('app.free_trial_days')),
            ]), 
            function (User $user) use ($input) {
                // $this->createTeam($user, $input);
                    //## BEGIN EDIT - if there's an invite, attach them accordingly ##
                    if (isset($input['invite'])) {
                        if ($invitation = Invitation::where('code', $input['invite'])->first()) {
                            if ($team = $invitation->team) {
                                $team->users()->attach(
                                    $user,
                                    ['role' => $invitation->role,
                                    'plan_mode' => 'Invite'
                                    ]
                                );
                            $user->current_team_id = $team->id;
                            $user->save();
                            TeamMemberAdded::dispatch($team, $user);
                            $invitation->delete();
                            }
                        }
                    }
                    else{
                        if(isset($input['teamname'])){
                            $this->createTeam($user, $input);
                            $d=$input['team_slug'];
                        }else{
                            $user->save();
                        }
                       
                    }
                //## END EDIT ##
               
            });
           
        });
        // return redirect('http://gill.localhost:8000/dashboard');
        return $NewUser;
       
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user, array $input)
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
        return redirect('/dashboard');
    }
}