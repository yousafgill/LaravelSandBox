<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Board;
use App\Models\User;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class BoardSetting extends Component
{
    public $selectedBoard;
    public $name="";
    public $slug="";
    public $accessType="";
    public $success="";
    public $teamurl="";

    public $listeners=[
                        'DeleteBoard'=>'DeleteBoard',
                        'LoadSelectedBoard'=>'LoadSelectedBoard'
                      ];


    public function DeleteBoard(){
        $id=$this->selectedBoard->id;
        //dd($id);
        Board::destroy($id);
        return redirect('/dashboard/boards');
    }

    public function mount($id){
        $this->LoadSelectedBoard($id);
        $teamid=Auth::user()->current_team_id;
        $team=Team::find($teamid);
        
        $this->teamurl='http://'.$team->team_slug.'.'. \config('app.appdomain').'/boards/';

      
    }
    protected $rules = [
        'name' => 'required|min:3',
        'slug' => 'required|min:3',
    ];
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

    public function LoadSelectedBoard($id){
        
        $this->selectedBoard=Board::find($id);
        $this->name=$this->selectedBoard->name;
        $this->slug=$this->selectedBoard->slug;

    }
    public function updated($propertyName)
    {
          if ($propertyName == "name"){
            $this->validateOnly($propertyName);
            $this->slug = $this->generateSlug($this->name);
         }
    }
    public function UpdateBoardAppearance(){
  
        $this->validate();
  
        //Catch this here in case the user changes the Slug after adding in the Board Name
        $this->slug = $this->generateSlug($this->slug);
  
        // Retrieve the currently authenticated user...
        $user = Auth::user();
        //dd($user);
        $bid=$this->selectedBoard->id;
        Board::find($bid)->update([
            'name'=>$this->name,
            'slug'=>$this->slug,
            'access_type'=> $this->accessType
        ]);
       
        $this->success = 'Board has been created.';
  
        // $this->clearFields();
        // $this->resetErrorBag();
        // $this->resetValidation();
        //dd("$this->$name, $this->$slug, $this->$accessType");
        return redirect()->to('/dashboard/boards');
      }
  
      private function clearFields()
      {
          $this->name = '';
          $this->slug = '';
          $this->accessType = 'Public';
      }
        public function render()
        {
            return view('livewire.board-setting')->layout('layouts.app');
        }
}
