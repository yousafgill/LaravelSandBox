<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\status;
class StatusesList extends Component
{

    public $statuses;
    public $counter = 0;
    public $ids = array();
  

    public function mount(){
        $this->statuses=status::get();
    }
   
    public function render()
    {
        return view('livewire.statuses-list');
    }
}
