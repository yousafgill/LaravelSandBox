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
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
class PostDetail extends Component
{
    public $SelectedPost;
    public $boards;
    public $statuses;           // List of Statuses to be shown in Dropdown list on post attribute form
    public $owners;             //this is List of Users to be used as owners
    public $categories;         // list of categories to be used in dropdown for post attribute


    public $estimated='';       //model property for estimated date to be changed on post att ribute form
    public $board_id='';        //model property for Board Id to be chan ged on Post Attribute Form
    public $status_id='';       //model property for status id to be changed on Post Attribute Form
    public $category_id='';     //model property for category id to be changed on post attribute form
    
    public $sessionteamid;
    public $sessionteamslug;

    public $post_current_board;
    public $post_current_status;
    public $post_current_estimated;

    public $CurrentPostcomments;
    public $message;
    public $commentreply;

    protected $listeners =[
                            'postselected'=>'handlepostselected',
                            // 'boardselected'=>'handleboardselected',
                            'ShowReplyBox' =>'ShowReplyBox',
                            'postboardchanged'=>'postboardchanged',
                            'poststatuschanged'=>'poststatuschanged',
                            'postestimatedchanged'=>'postestimatedchanged',
                            'postcategorychanged'=>'postcategorychanged'
                        ];

    public function mount(){
        // $this->SelectedPost=Post::latest()->first();
        $this->SetSessionTeamId();
        $this->boards=Board::where('team_id','=',$this->sessionteamid)->get();
        $this->categories=Category::get();
        $this->message="";
        $this->statuses=status::get();
        $this->owners=User::where('current_team_id','=',$this->sessionteamid)->get();
        // $this->LoadCurrentPostComments();
    }

    public function SetSessionTeamId(){
        $this->sessionteamslug=session('tenant')->team_slug;
        $tm=Team::where('team_slug','=',$this->sessionteamslug)->first();
        $this->sessionteamid=$tm->id;
        // dd($this->sessionteamid);
    }

    /**
     *  This function is called when user select post category
     *  Author  : Yousaf Gill
     *  Date    : 11-Feb-2021
     * @return void
     */
    public function postcategorychanged(){
       if($this->SelectedPost)
       {
           if ($this->category_id>0) {
            $pid=$this->SelectedPost->id;
            $pc=PostCategory::where('post_id','=',$pid)->first();
            if($pc ==null)
            {
               $postcat= PostCategory::create([
                    'post_id'=>$pid,
                    'category_id'=>$this->category_id
                ]);
            }
            else{
                $id=$pc->id;
                PostCategory::find($id)->update([
                    'post_id'=>$pid,
                    'category_id'=>$this->category_id
                ]);
            }
           }
       }
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
    
    
    /**
     *  This function is event handler when user change board of post on post attribute form
     *  Author  : Yousaf Gill
        Date    : 11-Feb-2021
     * @return void
     */
    public function postboardchanged(){
        $pid=$this->SelectedPost->id;
        Post::find($pid)->update([
            'board_id'=>$this->board_id
        ]);
    }

    /**
     * Event Handler for Post Status Changed
     *
     * @return void
     */
    public function poststatuschanged(){
           // dd($this->status_id);
            $pid=$this->SelectedPost->id;
            Post::find($pid)->update([
                'status_id'=>$this->status_id
            ]);
    }

    /**
     * Event Handler for Post Estimated Date Changed
     *
     * @return void
     */
    public function postestimatedchanged(){

            $pid=$this->SelectedPost->id;
            Post::find($pid)->update([
                'estimated'=>$this->estimated
            ]);
    }

    /**
     * Event Handler for Selected Post Changed from Post List
     *
     * @param [type] $postid
     * @return void
     */
    public function handlepostselected($postid){
        $this->SelectedPost=Post::where('id',$postid)->first();
        $this->estimated=$this->SelectedPost->estimated;

        $this->board_id=$this->SelectedPost->board_id;
        $this->status_id=$this->SelectedPost->status_id;
        $this->render();
    }


    // public function handleboardselected($boardid,$event){
    //     if($event==true){
    //         $this->SelectedPost=Post::where('board_id',$boardid)->latest()->first();
    //         if($this->SelectedPost)
    //         {
    //          $this->board_id=$this->SelectedPost->board_id;
    //          $this->status_id=$this->SelectedPost->status_id;
    //         }
    //          $this->render();
    //     }
    // }
    public function render()
    {
        if($this->SelectedPost)
        {
            $this->board_id=$this->SelectedPost->board_id;
            $this->status_id=$this->SelectedPost->status_id;
            return view('livewire.post-detail',['CurrentPostcomments'=>$this->LoadCurrentPostComments()]);
        }
        else{
            return view('livewire.post-detail');
        }
        
       
    }
    public function PostComment(){
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

    /**
     * Show Reply Box
     *
     * @param [type] $commetid
     * @return void
     */
    public function ShowReplyBox($commetid){
        $this->emit('show');
    }

    /**
     * post Comment Reply
     *
     * @param [type] $commetid
     * @return void
     */
    public function PostCommentReply($commetid){
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
 
    /**
     * Clears Field values
     *
     * @return void
     */
    public function clearFields(){
        $this->message="";
        $this->commentreply="";

    }
}