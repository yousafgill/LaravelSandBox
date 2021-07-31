<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class CancelSubscription extends Component
{

    private $my_plan;


    protected $listeners=['handlecancel'];


    public function mount(){

    }

    public function handlecancel(){
        $team = Team::where('user_id','=',Auth()->id())->first();
        $this->my_plan=\DB::table('subscriptions')
                    ->where('team_id','=',$team->id)
                    ->first();
        $planid=$this->my_plan->id;
        $tid=$team->id;
        $usrid=$team->user_id;
        $team_owner=User::find($usrid);

        $team->subscriptions()->updateOrInsert(
            ['team_id' =>$tid ],
            ['stripe_status' => 'Cancel']);
    
        $team_owner->update([
            'plan_mode' =>'Cancelled'
        ]);
        return redirect()->to('/dashboard');
        // dd($planid);
    }

    public function render()
    {
        return view('livewire.cancel-subscription')->layout('layouts.app');
    }
}
