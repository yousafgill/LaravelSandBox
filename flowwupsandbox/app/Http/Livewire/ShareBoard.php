<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
class ShareBoard extends Component
{
    public $board;
    public $boardslug;
    
    public function mount($id){
        $this->board=Board::find($id);
        $this->boardslug=$this->board->slug;
    }
    
    public function render()
    {
        return view('livewire.share-board');
    }
}
