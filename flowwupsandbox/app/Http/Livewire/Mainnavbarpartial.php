<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Mainnavbarpartial extends Component
{
    
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