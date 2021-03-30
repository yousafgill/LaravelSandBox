<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Board;
use App\Models\Post;
class RoadmapSecondnavPartial extends Component
{
    public $boards;
    public $boardname='Give feedback';
    public $listeners=['boardurlchanged'];

    public function boardurlchanged($bname){
        $this->boardname=$bname;
    }

    public function mount(){
       // $this->boards=Board::get();
    }
    private function LoadBoards(){
        $this->boards=\DB::table('boards')
        ->where('boards.deleted_at','=',null)
        ->leftjoin(\DB::raw('(select board_id,count(id) as totalposts from posts group by board_id) p'),'boards.id','=','p.board_id')
        ->select('boards.*',
                \DB::raw('IFNULL(p.totalposts,0) as totalposts')
                )
        ->get();
    }
    public function render()
    {
        $this->LoadBoards();
        return view('livewire.roadmap-secondnav-partial');
    }
}
