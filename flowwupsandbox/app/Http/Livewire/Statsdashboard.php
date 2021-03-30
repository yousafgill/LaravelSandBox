<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Post;
use App\Models\Comment;
use App\Models\voter;
class Statsdashboard extends Component
{
    public $totalposts=0;
    public $totalvotes=0;
    public $totalcomments=0;

    public function mount(){

        
    }

    public function render()
    {
        $this->totalposts=Post::count();
        $this->totalvotes=voter::sum('upvote');
        $this->totalcomments=Comment::count();
        return view('livewire.statsdashboard');
    }
}
