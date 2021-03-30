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

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

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
            'password' => $this->passwordRules(),
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), 
            function (User $user) use ($input) {
                // $this->createTeam($user, $input);

                    //## BEGIN EDIT - if there's an invite, attach them accordingly ##
                    if (isset($input['invite'])) {
                        if ($invitation = Invitation::where('code', $input['invite'])->first()) {
                            if ($team = $invitation->team) {
                                $team->users()->attach(
                                    $user,
                                    ['role' => $invitation->role]
                                );
                            $user->current_team_id = $team->id;
                            $user->save();
                            TeamMemberAdded::dispatch($team, $user);
                            $invitation->delete();
                            }
                        }
                    }
                    else{
                        $this->createTeam($user, $input);
                    }
                    //## END EDIT ##

            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user, array $input)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => $input['teamname'],
            'personal_team' => true,
            'team_slug' => $input['team_slug']
        ]));
    }
}
