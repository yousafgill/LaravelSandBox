<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class RoadmapTopnavPartial extends Component
{

    public function mount(){
        //dd(Auth()->id());
    }
    public function render()
    {
        if (Auth::check()) {
            // dd(Auth::user()->current_team_id);
            if(Auth::user()->current_team_id !=null )
            {
                $company=Auth()->user()->currentTeam;
                return view('livewire.roadmap-topnav-partial',compact('company'));
            }else{
                return view('livewire.roadmap-topnav-partial');
            }

        }
       else{
            return view('livewire.roadmap-topnav-partial');
       }
        // return view('livewire.roadmap-topnav-partial');
    }
}
