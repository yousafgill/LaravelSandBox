<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChangePasswordPublic extends Component
{
    public function render()
    {
        return view('livewire.change-password-public')->layout('layouts.roadmap');
    }
}
