<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Post;
use App\Models\voter;
class NewPosts extends Component
{
    public $newposts;
    public $posts;

    public $listeners=['NewPostsUpVotedHandler'=>'NewPostsUpVotedHandler'];

    /**
     * this method is called when user upvote from new posts list
     *
     * @param [type] $id
     * @return void
     */
    public function NewPostsUpVotedHandler($id){
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

    public function mount(){
        // LoadNewposts();
       
    }

    /**
     * This method loads new posts and make available for the list
     *
     * @return void
     */
    private function LoadNewposts(){
        $this->newposts=\DB::table('posts')
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
        ->latest()
        ->take(3)
        ->get();
    }

    /**
     * Render method of the component
     *
     * @return void
     */
    public function render()
    {
        $this->LoadNewposts();
        return view('livewire.new-posts');
    }
}
