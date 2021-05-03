<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Team;
class BoardsHome extends Component
{
    public $boards;
    public $sessionteamid;
    public $sessionteamslug;

    public function mount(){
        $this->SetSessionTeamId();
    }
    
    public function SetSessionTeamId(){
        $this->sessionteamslug=session('tenant')->team_slug;
        $tm=Team::where('team_slug','=',$this->sessionteamslug)->first();
        $this->sessionteamid=$tm->id;
        // dd($this->sessionteamid);
    }

    public function render()
    {
        $this->boards=\DB::table('boards')
                            ->leftjoin('posts','boards.id','=','posts.board_id')
                            ->where('boards.deleted_at','=',null)
                            ->where('boards.team_id','=',$this->sessionteamid)
                            ->groupBy('posts.board_id','boards.name','boards.id','boards.deleted_at','boards.slug')
                            ->select(\DB::raw('count(*) as totalposts'),
                                    \DB::raw('sum(votes) as totalvotes'),
                                    'posts.board_id','boards.name as boardname',
                                    'boards.id','boards.deleted_at','boards.slug')
                            ->get();
        return view('livewire.boards-home');
    }
}
