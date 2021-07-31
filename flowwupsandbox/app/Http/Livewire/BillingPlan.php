<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BillingPlan extends Component
{
    private $my_plan;
    public $starter_class='';
    public $growth_class='';
    public $business_class='';
    private $color=' alpha-primary ';
    public $planname='';
    public $planstatus='';
    public $sbtn='';
    public $gbtn='';
    public $bbtn='';

    protected $listeners=['reactivateplan'];

    public function mount(){
        //
        $this->GetCurrentPlan();
    }


    public function reactivateplan(){
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
            ['stripe_status' => 'Active']);
    
        $team_owner->update([
            'plan_mode' =>'Subscription'
        ]);
        return redirect()->to('/dashboard');

    }

    protected function GetCurrentPlan(){
        // $team = Team::findOrFail(Auth()->id());
        $team = Team::where('user_id','=',Auth()->id())->first();
        $this->my_plan=\DB::table('subscriptions')
                    ->where('team_id','=',$team->id)
                    ->first();
        $this->planname=$this->my_plan->name;
        $this->planstatus=$this->my_plan->stripe_status;
       
        switch ($this->my_plan->name) {
            case "Starter":
                $this->starter_class=$this->color;
                $this->growth_class='';
                $this->business_class='';
                $this->sbtn='Subscribed';
                $this->gbtn='Upgrade';
                $this->bbtn='Upgrade';

                break;
            case "Growth":
                $this->starter_class='';
                $this->growth_class=$this->color;
                $this->business_class='';
                $this->sbtn='Downgrade';
                $this->gbtn='Subscribed';
                $this->bbtn='Upgrade';
                break;
            case "Business":
                $this->starter_class='';
                $this->growth_class='';
                $this->business_class=$this->color;
                $this->sbtn='Downgrade';
                $this->gbtn='Downgrade';
                $this->bbtn='Subscribed';
                break;
            default:
            $this->starter_class='';
            $this->growth_class='';
            $this->business_class='';
            $this->sbtn='Subscribe';
            $this->gbtn='Subscribe';
            $this->bbtn='Subscribe';
        }
    }

    public function render()
    {
        $this->GetCurrentPlan();
        return view('livewire.billing-plan')->layout('layouts.app');
    }
}
