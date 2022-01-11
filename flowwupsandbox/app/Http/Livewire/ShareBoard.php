<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Team;
use App\Models\User;
use App\Models\plan;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\Auth;

class ShareBoard extends Component
{
    public $board;
    public $boardslug;
    public $boardurl="";

    public function mount($id){
        $this->board=Board::find($id);
        $this->boardslug=$this->board->slug;

        $teamid=Auth::user()->current_team_id;
        $team=Team::find($teamid);
        $this->boardurl='http://'.$team->team_slug.'.'. \config('app.appdomain').'/boards/'.$this->boardslug;

    }
    
    public function render()
    {
        return view('livewire.share-board');
    }
}
