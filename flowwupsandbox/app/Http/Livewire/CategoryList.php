<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
class CategoryList extends Component
{
    public $categories;
    public $selectedCategory='';
    public $selectedCategoryId='';


    public function mount(){
        $this->selectedCategory=Category::latest()->first();
    }
    public function render()
    {
        $this->selectedCategory=Category::latest()->first();
        $this->categories=Category::get();
        return view('livewire.category-list');
    }
}
