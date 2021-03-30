<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CreateCategory extends Component
{
    public $title;
    public $category_color;
    public $success;
    public $is_active=true;

    public function render()
    {
        return view('livewire.create-category')->layout('layouts.post');
    }
     protected $rules = [
        'title' => 'required|min:3'
    ];

    public function SaveCategory(){
        $this->validate();

  
        // Retrieve the currently authenticated user...
        $user = Auth::user();
        //dd($user);
  
        $board = new Category();
        $board->title = $this->title;
        $board->category_color = $this->category_color;
        $board->is_active = $this->is_active;
        
        $board->save();
        $this->success = 'Category has been created.';
  
        $this->resetErrorBag();
        $this->resetValidation();

        return redirect()->to('/dashboard/posts');
    }
}
