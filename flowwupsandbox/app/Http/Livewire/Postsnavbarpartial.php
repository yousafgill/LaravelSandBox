<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Postsnavbarpartial extends Component
{
    public function render()
    {
        if (Auth::check()) {
            $company=Auth()->user()->currentTeam;
            return view('livewire.postsnavbarpartial',compact('company'));
        }
       else{
            return view('livewire.postsnavbarpartial');
       }
    
        
    }
}
