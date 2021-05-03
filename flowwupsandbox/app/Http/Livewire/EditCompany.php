<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
class EditCompany extends Component
{
    public $team_slug;
    public function render()
    {
        $this->team_slug=Auth::user()->currentteam->team_slug;
        return view('livewire.edit-company');
    }
    public function UpdateCompany(){
        $id= Auth::user()->currentteam->id;
        Team::find($id)->update([
            'team-slug'=>$this->team_slug
        ]);
        
    }
}
