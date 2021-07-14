<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search;
    
    protected $listeners = [
        'productAddedToCart' => 'save',
    ];

    public function mount(): void
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => $this->search === null ?
                Product::paginate(12) :
                Product::where('name', 'like', '%' . $this->search . '%')->paginate(12)
        ]);
    }

    public function save()
    { 
        session()->flash('message', 'Producto agregado al carrito.');
    }
}
