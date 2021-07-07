<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductCard extends Component
{
    public $quantity;
    public $product;

    public function mount(): void
    {
        $this->quantity = 1;
    }

    public function render()
    {
        return view('livewire.product-card');
    }

    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);
        Cart::add(
            $product->id,
            $product->name,
            $this->quantity,
            $product->price,
        );

        $this->emit('productAddedToCart');
    }
}
