<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Postsidebarpartial extends Component
{
    public $dateperiod="thirtydays";
    public $todate;
    
    public function render()
    {
        return view('livewire.postsidebarpartial');
    }
}
