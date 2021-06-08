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
        if(session('tenant') !=null){
            $this->sessionteamslug=session('tenant')->team_slug ;
            $tm=Team::where('team_slug','=',$this->sessionteamslug)->first() ? : abort(404);
            $this->sessionteamid=$tm->id;
    
        }
        else{
            abort(404);
        }
    }

    public function render()
    {

        $this->boards=\DB::table('boards')
        // ->where('boards.deleted_at','=',null)
        ->where('boards.team_id','=',$this->sessionteamid)
        ->leftjoin(\DB::raw('(select p.board_id,count(p.id) as totalposts,sum(p.is_new) as newposts,count(c.id) as totalcomments,count(c.is_new) as newcomments,sum(v.upvote) as totalvotes from posts p INNER JOIN voters v on v.post_id=p.id LEFT JOIN comments c on c.post_id = p.id group by p.board_id) p'),'boards.id','=','p.board_id')
        ->select('boards.id','boards.name as boardname','boards.deleted_at','boards.slug','access_type',
                \DB::raw('IFNULL(p.totalposts,0) as totalposts'),
                \DB::raw('IFNULL(p.newposts,0) as newposts'),
                \DB::raw('IFNULL(p.totalvotes,0) as totalvotes'),
                \DB::raw('IFNULL(p.totalcomments,0) as totalcomments'),
                \DB::raw('IFNULL(p.newcomments,0) as newcomments')
                )
        ->get();

        return view('livewire.boards-home');
    }
}
