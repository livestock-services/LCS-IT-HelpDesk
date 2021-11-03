<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;

class CategorySubCategory extends Component
{
    public $categories;
    public $subCategories;

    public $selectedCategorie = NULL;

    public function mount()
    {
        $this->categories = Category::all();
        $this->subCategories = collect();
    }

    public function render()
    {
        return view('livewire.category-sub-category');
    }

    public function updatedSelectedCategory($categoryId)
    {
        if (!is_null($categoryId)) {
            $this->subCategories = SubCategory::where('categoryId', $categoryId)->get();
        }
    }
}
