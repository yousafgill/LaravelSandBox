<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Post;
use App\Models\voter;
use Illuminate\Support\Facades\Auth;

class CreatePost extends Component
{   
    public $board_id;
    public $user_id;
    public $status_id;
    public $owner_id;
    public $category_id;
    public $title;
    public $slug;
    public $detail;
    public $public_url;
    public $votes=0;
    public $estimated;

    public $boards;
    public $success="";

    public function mount(){
        $this->board_id=Board::first()->id;
        $this->boards=Board::get();
        $this->success="";
    }
    
    public function render()
    {
        return view('livewire.create-post')->layout('layouts.post',['header'=>'Create Post']);
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

    public function SavePost(){

        //$this->validate();
  
        //Catch this here in case the user changes the Slug after adding in the Board Name
        $this->slug = $this->generateSlug($this->title);
  
        // Retrieve the currently authenticated user...
        $user = Auth::user();
  
        $pst = new Post();
        $pst->board_id = $this->board_id;
        $pst->title = $this->title;
        $pst->slug = $this->slug;
        $pst->detail = $this->detail;
        $pst->status_id = 1;
        $pst->owner_id = 1;
        $pst->category_id = 1;
        $pst->votes = 1;
        $pst->user_id =  $user->id;
        $pst->save();
        $this->success = 'Post has been created.';
  
        $pid=$pst->id;

        voter::create([
            'user_id'=> $user->id,
            'post_id'=>$pid,
            'upvote'=>1
        ]);

        return redirect()->to('/dashboard/posts/-1');
        // $this->clearFields();
        // $this->resetErrorBag();
        // $this->resetValidation();
        //dd("$this->$name, $this->$slug, $this->$accessType");
  
      }
}
