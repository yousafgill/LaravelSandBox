<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Team;
class BoardsList extends Component
{
    public $boards;
    public $sessionteamid;
    public $sessionteamslug;

    protected $listeners=['RefreshBoards'];

    public function mount(){
        
        // $this->boards=Board::get();
        $this->SetSessionTeamId();
    }
    
    

    
    public function SetSessionTeamId(){
        $this->sessionteamslug=session('tenant')->team_slug;
        $tm=Team::where('team_slug','=',$this->sessionteamslug)->first();
        $this->sessionteamid=$tm->id;
        // dd($this->sessionteamid);
    }
    
    public function RefreshBoards(){
        $this->render();
    }
    public function render()
    {
        $this->boards=Board::where('boards.team_id','=',$this->sessionteamid)->get();
        return view('livewire.boards-list');
    }
}