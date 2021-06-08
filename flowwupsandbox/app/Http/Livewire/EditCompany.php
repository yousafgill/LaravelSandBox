<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Team;
class EditCompany extends Component
{
    public $team_slug;
    private $slug=array();
    public function render()
    {
        $this->team_slug=Auth::user()->currentteam->team_slug;
        return view('livewire.edit-company');
    }
    public function UpdateCompany(){
        // array_push($this->slug,$this->team_slug);
        // dd($this->slug);
        // Validator::make($this->slug, [
        //     'team_slug' =>['unique:teams,team_slug'],
        // ])->validate();
        $id= Auth::user()->currentteam->id;
        Team::find($id)->update([
            'team_slug'=>$this->team_slug
        ]);
        
    }
}
