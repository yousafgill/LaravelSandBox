<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class Createboard extends Component
{
    public $name="";
    public $slug="";
    public $accessType="";
    public $success="";

    protected $rules = [
        'name' => 'required|min:3',
        'slug' => 'required|min:3',
    ];

    public function mount(){
        $this->clearFields();
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


    public function updated($propertyName)
    {
          if ($propertyName == "name"){
            $this->validateOnly($propertyName);
            $this->slug = $this->generateSlug($this->name);
         }
    }


    public function submitForm(){

      $this->validate();

      //Catch this here in case the user changes the Slug after adding in the Board Name
      $this->slug = $this->generateSlug($this->slug);

      // Retrieve the currently authenticated user...
      $user = Auth::user();
      

      $board = new Board();
      $board->name = $this->name;
      $board->slug = $this->slug;
      $board->created_by = $user->id;
      $board->access_type = $this->accessType;
      $board->team_id = $user->current_team_id;

      $board->save();
      $this->success = 'Board has been created.';

      $this->clearFields();
      $this->resetErrorBag();
      $this->resetValidation();
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
        return view('livewire.createboard')->layout('layouts.app', ['header' => 'Create Board']);
    }
}