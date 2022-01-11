<?php

 namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Post;
use App\Models\Comment;
use App\Models\voter;
use App\Models\Team;
use Carbon\Carbon;
class Statsdashboard extends Component
{
    public $totalposts=0;
    public $totalvotes=0;
    public $totalcomments=0;
    public $sessionteamid;
    public $sessionteamslug;
    public $dateperiod="thirtydays";
    public $listeners=['statsdatechanged'];
    public $todate;
    public function mount(){

        // $this->todate=carbon::today()->toDateTimeString();
        $this->statsdatechanged();
        $this->SetSessionTeamId();
    }
    
    public function statsdatechanged(){
        switch ($this->dateperiod) {
            case 'all':
                # code...
                $this->todate=carbon::createFromTimestamp(0)->toDateTimeString();
                break;
            case 'today':
                # code...
                $this->todate=carbon::today()->toDateTimeString();
                break;
            case 'sevendays':
                # code...
                $this->todate=carbon::today()->subDays(7);
                break;
            case 'fifteendays':
                # code...
                $this->todate=carbon::today()->subDays(15);
                break;
            case 'thirtydays':
                # code...
                $this->todate=carbon::today()->subDays(30);
                break;
            default:
                # code...
                $this->todate=carbon::today()->toDateTimeString();
                break;
        }
        // dd($this->dateperiod);
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

    public function LoadData(){
// dd(carbon::today()->toDateTimeString());
        // $this->totalposts=Post::count();
        $this->totalposts=\DB::table('posts')
                        ->where('posts.created_at','>=', $this->todate)                
                        ->where('boards.team_id','=',$this->sessionteamid)
                        ->join('boards','posts.board_id','=','boards.id')
                        ->count();
        // $this->totalvotes=voter::sum('upvote');
        $this->totalvotes=\DB::table('voters')
                        ->where('voters.created_at','>=', $this->todate)
                        ->where('boards.team_id','=',$this->sessionteamid)
                        ->join('posts','voters.post_id','=','posts.id')
                        ->join('boards','posts.board_id','=','boards.id')
                        ->sum('upvote');
        // $this->totalcomments=Comment::count();
        $this->totalcomments=\DB::table('comments')
                        ->where('comments.created_at','>=', $this->todate)
                        ->where('boards.team_id','=',$this->sessionteamid)
                        ->join('posts','comments.post_id','=','posts.id')
                        ->join('boards','posts.board_id','=','boards.id')
                        ->count();
    }
    public function render()
    {
        $this->LoadData();
        return view('livewire.statsdashboard');
    }
}
