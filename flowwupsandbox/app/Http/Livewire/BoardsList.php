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
    public $boardslimit=0;
    protected $listeners=['RefreshBoards'];

    public function mount(){
        $this->CheckLimit();
        // $this->boards=Board::get();
        $this->SetSessionTeamId();
    }

    public function SetSessionTeamId(){
        if(session('tenant') !=null){
            $this->sessionteamslug=session('tenant')->team_slug ;
            $tm=Team::where('team_slug','=',$this->sessionteamslug)->first() ? : abort(404);
            $this->sessionteamid=$tm->id;
        }
        else{
            abort(404);
        }
    }
    
    public function CheckLimit(){
        $user=\Auth::user();
        $teamid=\Auth::user()->current_team_id;
        $teamplan=\DB::table('subscriptions as s')
                    ->where('s.team_id','=',$teamid)
                    ->join('plans as p','p.plan_stripe_code','=','s.stripe_id')
                    ->select('p.*')
                    ->first();

        $this->boardslimit=$teamplan->total_active_boards;
    }


    public function RefreshBoards(){
        $this->render();
    }
    public function render()
    {
        $this->boards=Board::where('boards.team_id','=',$this->sessionteamid)
                    ->oldest()
                    ->take($this->boardslimit)
                    ->get();
        return view('livewire.boards-list');
    }
}