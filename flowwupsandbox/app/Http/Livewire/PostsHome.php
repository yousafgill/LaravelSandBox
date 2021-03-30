<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostsHome extends Component
{

    public function mount(){

    }
    public function render()
    {
        // return view('livewire.posts-home');
        return view('livewire.posts-home')->layout('layouts.post');
    }
}
