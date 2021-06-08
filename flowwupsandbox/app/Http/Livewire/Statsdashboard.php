<?php

 namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Post;
use App\Models\Comment;
use App\Models\voter;
use App\Models\Team;
class Statsdashboard extends Component
{
    public $totalposts=0;
    public $totalvotes=0;
    public $totalcomments=0;
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
        // $this->totalposts=Post::count();
        $this->totalposts=\DB::table('posts')
                        ->where('boards.team_id','=',$this->sessionteamid)
                        ->join('boards','posts.board_id','=','boards.id')
                        ->count();
        // $this->totalvotes=voter::sum('upvote');
        $this->totalvotes=\DB::table('voters')
                        ->where('boards.team_id','=',$this->sessionteamid)
                        ->join('posts','voters.post_id','=','posts.id')
                        ->join('boards','posts.board_id','=','boards.id')
                        ->sum('upvote');
        // $this->totalcomments=Comment::count();
        $this->totalcomments=\DB::table('comments')
                        ->where('boards.team_id','=',$this->sessionteamid)
                        ->join('posts','comments.post_id','=','posts.id')
                        ->join('boards','posts.board_id','=','boards.id')
                        ->count();
        return view('livewire.statsdashboard');
    }
}
