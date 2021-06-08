<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\Post;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
class EditPost extends Component
{
    public $board_id;
    public $selected_board_id;
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
    public $SelectedPost;

    public $sessionteamid;
    public $sessionteamslug;

    public function mount($id){
        $this->SetSessionTeamId();

        $this->boards=Board::where('team_id','=',$this->sessionteamid)->get();
        $this->success="";
        $this->LoadPost($id);
    }

    /**
     * Load Current Post by Id
     *
     * @param [type] $id
     * @return void
     */
    public function LoadPost($id){
        $this->SelectedPost=Post::find($id);
        $this->board_id=$this->SelectedPost->board_id;
        $this->title=$this->SelectedPost->title;
        $this->detail=$this->SelectedPost->detail;
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

    /**
     * Modify Post record
     *
     * @return void
     */
    public function ModifyPost(){

        //Catch this here in case the user changes the Slug after adding in the Board Name
        $this->slug = $this->generateSlug($this->title);
  
        // Retrieve the currently authenticated user...
        $user = Auth::user();
  
        $pst = Post::find( $this->SelectedPost->id)->update([
            'board_id' => $this->board_id,
            'title' =>$this->title,
            'slug' =>$this->slug,
            'detail' =>$this->detail
        ]);
        $this->success = 'Post has been Updated.';
  
        return redirect()->to('/dashboard/posts/-1');
       
    }
    public function render()
    {
        return view('livewire.edit-post')->layout('layouts.post');
    }
}
