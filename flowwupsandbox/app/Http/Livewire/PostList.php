<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Board;
use App\Models\Status;
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
        
        public function mount(){

                $this->boardfilter=Board::all()->pluck('id')->toArray();
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
                $this->datefilter=$this->convertDateFilter($v);
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
                dd($catid);
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
                ->whereIn('posts.board_id',$this->boardfilter)
                ->whereIn('posts.status_id',$this->statusarray)
                ->where('posts.detail','like',$this->TextToSearch)
                ->where('posts.deleted_at','=',null)
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