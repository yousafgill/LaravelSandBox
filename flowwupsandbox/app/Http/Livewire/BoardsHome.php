<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
class BoardsHome extends Component
{
    public $boards;

    public function render()
    {
        $this->boards=\DB::table('boards')
                            ->leftjoin('posts','boards.id','=','posts.board_id')
                            ->where('boards.deleted_at','=',null)
                            ->groupBy('posts.board_id','boards.name','boards.id','boards.deleted_at','boards.slug')
                            ->select(\DB::raw('count(*) as totalposts'),
                                    \DB::raw('sum(votes) as totalvotes'),
                                    'posts.board_id','boards.name as boardname',
                                    'boards.id','boards.deleted_at','boards.slug')
                            ->get();
        return view('livewire.boards-home');
    }
}
