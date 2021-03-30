<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
class BoardsList extends Component
{
    public $boards;
   
    public function mount(){
        
        // $this->boards=Board::get();
    }
    protected $listeners=['RefreshBoards'];

    public function RefreshBoards(){
        $this->render();
    }
    public function render()
    {
        $this->boards=Board::get();
        return view('livewire.boards-list');
    }
}