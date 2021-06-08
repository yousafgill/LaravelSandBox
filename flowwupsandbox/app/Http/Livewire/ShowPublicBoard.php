<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\status;
use App\Models\Post;
use App\Models\voter;
use Illuminate\Support\Facades\Auth;

class ShowPublicBoard extends Component
{
    public $board;
    public $boardname='';
    public $title='';
    public $detail='';
 
    public $boardposts;
    public $statuslist;
    public $boardfilter;
    public $statusarray=array();
    public $OrderColumn='created_at';
    public $OrderValue='asc';
    public $searchText='';
    public $TextToSearch='%';

    public $status_display='Status';
    public $sort_display='Sort';

    public $listeners=['ShowSortedPosts'=>'ShowSortedPosts' ,
                        'SortPostsBy' => 'SortPostsBy',
                        'SearchByText' => 'SearchByText',
                        'statusselected' => 'handlestatusselected',
                        'UpVoted' => 'UpVotedHandler'
                    ];
    
    public function UpVotedHandler($id){
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

    public function updated($propertyName){
        if ($propertyName == "searchText"){
            $this->TextToSearch='%'.$this->searchText .'%';
        }
    }
                
    public function SearchByText(){
        $this->TextToSearch='%'.$this->searchText .'%';
    }
    
    public function handlestatusselected($status){
        $this->statusarray=array();
        if($status==-1){
            $this->statusarray=status::all()->pluck('id')->toArray();
            $this->status_display="Status";
        }
        else{
            array_push($this->statusarray,$status);
            $this->status_display=status::find($status)->title;
        }
    }

        /**
    * Called when user click on sorting dropdown
    *
    * @param [type] $sortby column name, which is passed through parameter
    * @param [type] $sort type either asc or desc
    * @return void
    */
    public function SortPostsBy($sortby, $sort,$display){
        $this->OrderColumn=$sortby;
        $this->OrderValue=$sort;
        $this->sort_display=$display;
    }

    
    public function mount($id){
        $this->board=Board::where('slug','=',$id)->first();
        $this->boardname=$this->board->title;
        $this->boardfilter=$this->board->id;
        $this->statusarray=status::all()->pluck('id')->toArray();
        $this->statuslist=status::all();
       
    }

    public function Loadposts(){
        $this->boardposts=\DB::table('posts')
        ->where('posts.board_id','=',$this->boardfilter)
        ->whereIn('posts.status_id',$this->statusarray)
        ->where('posts.detail','like',$this->TextToSearch)
        ->where('posts.deleted_at','=',null)
        ->join('statuses','posts.status_id','=','statuses.id')
        ->join(\DB::raw('(select post_id,sum(upvote) as totalvotes from  voters group by post_id) as v'),'v.post_id','=','posts.id')
        ->leftjoin(\DB::raw('(select post_id,count(id) as totalcomments from comments group by post_id) c'),'c.post_id','=','posts.id')
        ->select('posts.*',
                'statuses.title as status_title','v.totalvotes',
                'statuses.status_color',\DB::raw('IFNULL(c.totalcomments,0) as totalcomments')
                )
        ->orderBy($this->OrderColumn,$this->OrderValue)
        ->get();
    }
    protected function generateSlug($string = null, $separator = "-")
    {
        if (is_null($string)) {
            return "";
        }

        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        $slug = preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        $slug = strtolower($slug);

        return $slug;
    }

    public function CreatePost(){
         //Catch this here in case the user changes the Slug after adding in the Board Name
        $slug = $this->generateSlug($this->title);
  
         // Retrieve the currently authenticated user...
        $user = Auth::user();

        $pst = new Post();
        $pst->board_id = $this->board->id;
        $pst->title = $this->title;
        $pst->slug = $slug;
        $pst->detail = $this->detail;
        $pst->status_id = 1;
        $pst->owner_id =  $user->id;
        $pst->category_id = 1;
        $pst->votes = 1;
        $pst->user_id =  $user->id;
        $pst->save();
        
  
        $pid=$pst->id;
        voter::create([
            'user_id'=> $user->id,
            'post_id'=>$pid,
            'upvote'=>1
        ]);

        $this->ClearFields();
        // dd($slug);
    }

    public function ClearFields(){
        $this->title='';
        $this->detail='';
    }
    public function render()
    {
        // $this->emitTo('RoadmapSecondnavPartial','boardurlchanged',$this->board->name);
        $this->Loadposts();
        return view('livewire.show-public-board',compact($this->board))->layout('layouts.roadmap');
    }
}
