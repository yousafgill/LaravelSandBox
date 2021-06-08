<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Mainnavbarpartial extends Component
{
    
    public $trialdays;

    public function mount(){
        $this->CheckTrial();

    }

    public function CheckTrial(){
        $date = \Auth::user()->created_at;
        $now = Carbon::now();
        $diff = 15-($date->diffInDays($now));
        // dd($diff);
    }

    public function render()
    {
        if (Auth::check()) {
        
            $company='';
            if (Auth()->user()->currentTeam !=null) {
                $company=Auth()->user()->currentTeam;
            }
            else{
                $company='Guest';
            }
            return view('livewire.mainnavbarpartial',compact('company'));
        }
       else{
            return view('livewire.mainnavbarpartial');
       }
        
    }
}