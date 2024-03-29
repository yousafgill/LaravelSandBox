<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Board;
use App\Models\status;
use App\Models\Team;
use App\Models\Post;
use Carbon\Carbon;
class PostList extends Component
{
        public $posts='';
        public $checkstatus;
        public $boardfilter=array();
        public $statusarray=array();
        public $SelectedPost;
        public $selectedCategoryId='';

        public $OrderColumn='created_at';
        public $OrderValue='asc';
        public $searchText='';
        public $TextToSearch='%';
        
        public $board_counter=0;
        public $status_counter=0;
        public $datefilter;
        public $boardslimit=0;
        public $sessionteamid;
        public $sessionteamslug;

        public $dateperiod="thirtydays";
        public $todate;

        public function mount(){
                $this->DateChanged($this->dateperiod);
                $this->SetSessionTeamId();
                $this->CheckLimit();
                $this->boardfilter=Board::oldest()->take($this->boardslimit)->pluck('id')->toArray();
                $this->statusarray=Status::all()->pluck('id')->toArray();
        }
        protected $listeners =[
                        'postselected'=>'handlepostselected',
                        'boardselected'=>'handleboardselected',
                        'FilterCategoryChanged' =>'handleFilterCategoryChanged',
                        'SortPostBy' => 'SortPostBy',
                        'SearchByText' => 'SearchByText',
                        'statusselected' => 'handlestatusselected',
                        'DateChanged' => 'DateChanged'
                        ];
        public function DateChanged($v){
                // $this->datefilter=$this->convertDateFilter($v);
                switch ($v) {
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


        public function CheckLimit(){
                $user=\Auth::user();
                $teamid=\Auth::user()->current_team_id;
                $teamplan=\DB::table('subscriptions as s')
                            ->where('s.team_id','=',$teamid)
                            ->join('plans as p','p.plan_stripe_code','=','s.stripe_id')
                            ->select('p.*')
                            ->first();
                $this->boardslimit=$teamplan->total_active_boards;
        }

        private function convertDateFilter($label)
        {
                return $label;
        }

        /**
         * function called when user select status from the left sidebar
         * multiple statuses can be selected
         * @param [type] $statusid
         * @param [type] $event
         * @return void
         */
        public function handlestatusselected($statusid,$event){
                if($this->status_counter==0)
                {
                        $this->statusarray=array();
                }  
                if($event==true)
                {
                        array_push($this->statusarray,$statusid);
                        $this->status_counter++;
                }
                else if($event==false)
                {
                        $this->statusarray=array_diff($this->statusarray,array($statusid));
                        if(count($this->statusarray)==0){
                                $this->statusarray=Status::all()->pluck('id')->toArray();
                                $this->status_counter=0;
                        }
                }
        }
        public function handleFilterCategoryChanged($catid){
                // dd($catid);
        }
                
        public function handlepostselected($postid){
                //dd($postid);

        }

        /**
         * Property field updated when user types in search box
         *
         * @param [type] $propertyName
         * @return void
         */
        public function updated($propertyName){
                if ($propertyName == "searchText"){
                    $this->TextToSearch='%'.$this->searchText .'%';
                }
        }

        /**
         * Search by text filter, when user type in search box
         *
         * @return void
         */
        public function SearchByText(){
                $this->TextToSearch='%'.$this->searchText .'%';
        }
        
        /**
        * Called when user click on sorting dropdown
        *
        * @param [type] $sortby column name, which is passed through parameter
        * @param [type] $sort type either asc or desc
        * @return void
        */
        public function SortPostBy($sortby, $sort){
                $this->OrderColumn=$sortby;
                $this->OrderValue=$sort;
        }

        /**
        * Called When User check / uncheck boards from left sidebar
        *
        * @param [type] $boardid is ID of the selected board
        * @param [type] $event is checkbox status i.e. CHECKED / UNCHECKED
        * @return void
        */
        public function handleboardselected($boardid,$event){
                if($this->board_counter==0)
                {
                        $this->boardfilter=array();
                }  
                if($event==true)
                {
                        array_push($this->boardfilter,$boardid);
                        $this->board_counter++;
                }
                else if($event==false)
                {
                        $this->boardfilter=array_diff($this->boardfilter,array($boardid));
                        if(count($this->boardfilter)==0){
                                $this->boardfilter=Board::all()->pluck('id')->toArray();
                                $this->board_counter=0;
                        }
                }
        }
   

        /**
        * Render Method
        *
        * @return void
        */
        public function render()
        {
                $this->posts=\DB::table('posts')
                ->where('posts.created_at','>=', $this->todate) 
                ->whereIn('posts.board_id',$this->boardfilter)
                ->whereIn('posts.status_id',$this->statusarray)
                ->where('posts.detail','like',$this->TextToSearch)
                ->where('posts.deleted_at','=',null)
                ->where('boards.team_id','=',$this->sessionteamid)
                ->join('boards','posts.board_id','=','boards.id')
                ->join('statuses','posts.status_id','=','statuses.id')
                ->join(\DB::raw('(select post_id,sum(upvote) as totalvotes from  voters group by post_id) as v'),'v.post_id','=','posts.id')
                ->select('posts.*',
                        'statuses.title as status_title',
                        'statuses.status_color','v.totalvotes'
                        )
                ->orderBy($this->OrderColumn,$this->OrderValue)
                ->get();
                return view('livewire.post-list');
        }
}