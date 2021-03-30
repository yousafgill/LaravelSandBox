<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RoadmapTopnavPartial extends Component
{
    public $currentTeam;

    public function mount(){
        //dd(Auth()->id());
    }
    public function render()
    {
        return view('livewire.roadmap-topnav-partial');
    }
}
