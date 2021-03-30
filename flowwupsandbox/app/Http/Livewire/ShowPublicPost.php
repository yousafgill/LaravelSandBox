<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Post;
use App\Models\Board;
use App\Models\User;
use App\Models\Comment;
use App\Models\status;
use App\Models\Category;
use App\Models\PostCategory;
use App\Models\voter;
use Illuminate\Support\Facades\Auth;

class ShowPublicPost extends Component
{
    public $SelectedPost;
    public $CurrentPostcomments;

    //Properties for Comments
    public $message;
    public $commentreply;
    public $postvoters;
    public $postSlug='';

    public $listeners=  ['UpVotedHandler' => 'UpVotedHandler',
                        'PostPublicComment'=>'PostPublicComment',
                        'PostPublicCommentReply' =>'PostPublicCommentReply'
                        ];

    public function mount($id){
        $this->postSlug=$id;
        $this->LoadSelectedPost($this->postSlug);
        $this->message="";
      
    }

    public function PostPublicComment(){
        // Retrieve the currently authenticated user...
        $user = Auth::user();
        $comment = new Comment();

        $comment->message = $this->message;
        $comment->post_id = $this->SelectedPost->id;
        $comment->user_id =  $user->id;
        $comment->comment_level =  1;
        $comment->is_reply =  false;
        $comment->reply_to =  0;
        $comment->save();
        $this->success = 'Comment Posted';
        $this->clearFields();
    }


    public function PostPublicCommentReply($commetid){
        // Retrieve the currently authenticated user...
        $user = Auth::user();
        $comment = new Comment();

        $comment->message = $this->commentreply;
        $comment->post_id = $this->SelectedPost->id;
        $comment->user_id =  $user->id;
        $comment->comment_level =  2;
        $comment->is_reply =  true;
        $comment->reply_to =  $commetid;
        $comment->save();
        $this->success = 'Reply Posted';
        $this->clearFields();
    }

    private function LoadSelectedPost($id){
        $this->SelectedPost=Post::where('slug',$id)
                            ->leftJoin('statuses','statuses.id','=','posts.status_id')
                            ->join(\DB::raw('(select post_id,sum(upvote) as totalvotes from  voters group by post_id) as v'),'v.post_id','=','posts.id')
                            ->select('statuses.title as status_title','statuses.status_color','posts.*','v.totalvotes')
                            ->first();
    }

    private function LoadPostVoters(){
        $postid=$this->SelectedPost->id;
        $this->postvoters=\DB::table('voters')
                            ->join('users','voters.user_id','=','users.id')
                            ->where('voters.post_id','=',$postid)
                            ->where('voters.upvote','=',1)
                            ->select('users.name','voters.*')
                            ->get();
    }

     /**
     *  This function loads comments of the selected post
     *  Author  : Yousaf Gill
     *  Date    : 11-Feb-2021
     * @return void
     */
     private function LoadCurrentPostComments(){
        if ($this->SelectedPost) {
            # code...
            $this->CurrentPostcomments=\DB::table('comments')
            ->where('post_id','=',$this->SelectedPost->id)
            ->join('users','comments.user_id','=','users.id')
            ->select('comments.*' ,'users.name',
                    \DB::raw(" case when reply_to=0 THEN comments.id*10+comment_level else reply_to*10+comment_level end as ranking" ))
            ->orderby('ranking','asc')
            ->get();
        }
    }

    public function UpVotedHandler($id){
       if(Auth()->id()!=null)
        {
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
        else{
            dd('no authorized');
        }
    }

    public function render()
    { 
        $this->LoadPostVoters();
        $this->LoadSelectedPost($this->postSlug);
        return view('livewire.show-public-post',['CurrentPostcomments'=>$this->LoadCurrentPostComments()])->layout('layouts.roadmap');
    }

      //Clear Fields and Values
    public function clearFields(){
        $this->message="";
        $this->commentreply="";
    }
}