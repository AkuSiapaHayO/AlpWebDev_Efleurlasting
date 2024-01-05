<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public function render()
    {
        $products = Product::where('product_name', 'like', '%' . $this->search . '%')
            ->where('is_active', true)->orWhereHas('category', function ($query) {
                $query->where('category_name', 'like', '%' . $this->search . '%');
            })
            ->get();
        ;

        return view('livewire.search', ['products' => $products]);
    }

    public function submitSearch()
    {
        $this->render();
    }
}
