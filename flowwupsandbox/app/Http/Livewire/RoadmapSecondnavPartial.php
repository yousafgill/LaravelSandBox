<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Board;
use App\Models\Post;
use App\Models\Team;
class RoadmapSecondnavPartial extends Component
{
    public $boards;
    public $boardname='Give feedback';
    public $listeners=['boardurlchanged'];
    
    public $sessionteamid;
    public $sessionteamslug;

    public function boardurlchanged($bname){
        $this->boardname=$bname;
    }

    public function mount(){
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


    private function LoadBoards(){
        if(\Auth::check()){
            $this->boards=\DB::table('boards')
            ->where('boards.deleted_at','=',null)
            ->where('boards.team_id','=',$this->sessionteamid)
            ->leftjoin(\DB::raw('(select board_id,count(id) as totalposts from posts group by board_id) p'),'boards.id','=','p.board_id')
            ->select('boards.*',
                    \DB::raw('IFNULL(p.totalposts,0) as totalposts')
                    )
            ->get();
        }else{
            $this->boards=\DB::table('boards')
            ->where('boards.deleted_at','=',null)
            ->where('boards.access_type','=','Public')
            ->where('boards.team_id','=',$this->sessionteamid)
            ->leftjoin(\DB::raw('(select board_id,count(id) as totalposts from posts group by board_id) p'),'boards.id','=','p.board_id')
            ->select('boards.*',
                    \DB::raw('IFNULL(p.totalposts,0) as totalposts')
                    )
            ->get();
        }
       
    }
    public function render()
    {
        $this->LoadBoards();
        return view('livewire.roadmap-secondnav-partial');
    }
}
