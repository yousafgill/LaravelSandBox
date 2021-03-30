<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Board;
use App\Models\Status;
use App\Models\voter;

class PostByStatus extends Component
{
   
    public $plannedposts;
    public $inprogressposts;
    public $completeposts;

    public $status_planned=3;
    public $status_inprogress=4;
    public $status_completed=5;

    public $listeners=['StatsDashboardUpVotedHandler'=>'StatsDashboardUpVotedHandler'];

    /**
     * Mount method of the component
     *
     * @return void
     */
    public function mount(){
       $this->plannedposts=$this->getPosts($this->status_planned);
       $this->inprogressposts=$this->getPosts($this->status_inprogress);
       $this->completeposts=$this->getPosts($this->status_completed);
    }
    
    /**
     * Undocumented function
     *
     * @param [type] $status
     * @return void
     */
    private function getPosts($status){
        $p=\DB::table('posts')
        ->where('posts.status_id','=',$status)
        ->where('posts.deleted_at','=',null)
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
        return $p;
    }

    /**
     * function fires when user clicks on any upvote on stats dashboard
     *
     * @param [type] $id
     * @return void
     */
    public function StatsDashboardUpVotedHandler($id){
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
        $this->plannedposts=$this->getPosts($this->status_planned);
        $this->inprogressposts=$this->getPosts($this->status_inprogress);
        $this->completeposts=$this->getPosts($this->status_completed);
        return view('livewire.post-by-status');
    }
}
