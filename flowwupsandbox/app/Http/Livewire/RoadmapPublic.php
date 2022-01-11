<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Board;
use App\Models\Status;
use App\Models\voter;
use App\Models\Team;
class RoadmapPublic extends Component
{
    public $boards;
    public $plannedposts;
    public $inprogressposts;
    public $completeposts;
    public $sessionteamid;
    public $sessionteamslug;
    public $listeners=['RoadmapUpVotedHandler'=>'RoadmapUpVotedHandler'];

    public function mount(){
       
        $this->SetSessionTeamId();
        
        $this->LoadBoards();
        $this->LoadPlannedPosts();
        $this->LoadInprogressPosts();
        $this->LoadCompletePosts();
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
        // dd($this->sessionteamid);
    }
    /**
     * Load Planne Posts
     *
     * @return void
     */
    private function LoadPlannedPosts(){
        $this->plannedposts=\DB::table('posts')
        ->where('posts.status_id','=',3)
        ->where('posts.deleted_at','=',null)
        ->where('boards.team_id','=',$this->sessionteamid)
        ->join('statuses','posts.status_id','=','statuses.id')
        ->join('boards','posts.board_id','=','boards.id')
        ->join(\DB::raw('(select post_id,sum(upvote) as totalvotes from  voters group by post_id) as v'),'v.post_id','=','posts.id')
        ->leftjoin(\DB::raw('(select post_id,count(id) as totalcomments from comments group by post_id) c'),'c.post_id','=','posts.id')
        ->select('posts.*',
                'statuses.title as status_title',
                'boards.name as boardname','v.totalvotes',
                'statuses.status_color',\DB::raw('IFNULL(c.totalcomments,0) as totalcomments')
                )
        ->get();
    }

    /**
     * Load inprogress Posts
     *
     * @return void
     */
    private function LoadInprogressPosts(){
        $this->inprogressposts=\DB::table('posts')
        ->where('posts.status_id','=',4)
        ->where('posts.deleted_at','=',null)
        ->where('boards.team_id','=',$this->sessionteamid)
        ->join('statuses','posts.status_id','=','statuses.id')
        ->join('boards','posts.board_id','=','boards.id')
        ->join(\DB::raw('(select post_id,sum(upvote) as totalvotes from  voters group by post_id) as v'),'v.post_id','=','posts.id')
        ->leftjoin(\DB::raw('(select post_id,count(id) as totalcomments from comments group by post_id) c'),'c.post_id','=','posts.id')
        ->select('posts.*',
                'statuses.title as status_title',
                'boards.name as boardname','v.totalvotes',
                'statuses.status_color',\DB::raw('IFNULL(c.totalcomments,0) as totalcomments')
                )
        ->get();
    }

    /**
     * Load Completed Posts
     *
     * @return void
     */
    private function LoadCompletePosts(){
        $this->completeposts=\DB::table('posts')
        ->where('posts.status_id','=',5)
        ->where('posts.deleted_at','=',null)
        ->where('boards.team_id','=',$this->sessionteamid)
        ->join('statuses','posts.status_id','=','statuses.id')
        ->join('boards','posts.board_id','=','boards.id')
        ->join(\DB::raw('(select post_id,sum(upvote) as totalvotes from  voters group by post_id) as v'),'v.post_id','=','posts.id')
        ->leftjoin(\DB::raw('(select post_id,count(id) as totalcomments from comments group by post_id) c'),'c.post_id','=','posts.id')
        ->select('posts.*',
                'statuses.title as status_title',
                'boards.name as boardname','v.totalvotes',
                'statuses.status_color',\DB::raw('IFNULL(c.totalcomments,0) as totalcomments')
                )
        ->get();
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
            ->orderby('totalposts','desc')
            ->take(3)
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
            ->orderby('totalposts','desc')
            ->take(3)
            ->get();
        }
       
    }
   

    public function RoadmapUpVotedHandler($id){
        $usrid=Auth()->id();
        if(voter::where('user_id',$usrid)->where('post_id',$id)->exists()){
            $vot=voter::where('user_id',$usrid)->where('post_id',$id)->first()->upvote;
            $votr=voter::where('user_id',$usrid)->where('post_id',$id)->update([
                'upvote'=>$vot== 1 ? 0 : 1
            ]);
        }else{
            $votr=voter::create([
                'user_id'=>$usrid,
                'post_id'=>$id,
                'upvote'=>1
            ]);
        }
    }

    public function render()
    {
        $this->LoadBoards();                    
        $this->LoadPlannedPosts();
        $this->LoadInprogressPosts();
        $this->LoadCompletePosts();
        return view('livewire.roadmap-public')->layout('layouts.roadmap');
    }
}