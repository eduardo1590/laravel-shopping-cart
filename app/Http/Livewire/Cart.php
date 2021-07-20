<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart as CartFcd;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Models\Client;
use App\Models\Order;

class Cart extends Component
{
    protected $total;
    protected $content;
    public $orderNumber;
    public $buyer;

    protected $listeners = [
        'productAddedToCart' => 'updateCart',
    ];

    /**
     * Mounts the component on the template.
     *
     * @return void
     */
    public function mount(): void
    {
        $this->orderNumber = Order::max('number')+1;
        $this->updateCart();
    }
    
    public function render()
    {
        return view('livewire.cart', [
            'total' => $this->total,
            'content' => $this->content,
            'clients' => Client::all(),
        ]);
    }

    /**
     * Removes a cart item by id.
     *
     * @param string $id
     * @return void
     */
    public function removeFromCart(string $id): void
    {
        CartFcd::remove($id);
        $this->updateCart();
    }

    /**
     * Clears the cart content.
     *
     * @return void
     */
    public function clearCart(): void
    {
        CartFcd::clear();
        $this->updateCart();
    }

    /**
     * Updates a cart item.
     *
     * @param string $id
     * @param string $action
     * @return void
     */
    public function updateCartItem(string $id, string $action): void
    {
        $item = CartFcd::get($id);
        if (strcmp($action, '-') == 0){
            $qty = $item->qty - 1;
        }else{
            $qty = $item->qty + 1;
        }
        CartFcd::update($id, $qty);
        $this->updateCart();
    }

    /**
     * Rerenders the cart items and total price on the browser.
     *
     * @return void
     */
    public function updateCart()
    {
        $this->total = CartFcd::subtotal();
        $this->content = CartFcd::content();
    }

    public function checkout()
    {
        $this->updateCart();
        $this->buyer = Client::find($this->buyer);

        $customer = new Buyer([
            'name'          => $this->buyer->name,
            'address'       => $this->buyer->address,
            'custom_fields' => [
                'email' => $this->buyer->email,
                'phone' => $this->buyer->phone
            ],
        ]);

        $items = [];
        foreach ($this->content as $item){
            array_push($items, (new InvoiceItem())->title($item->name)->pricePerUnit($item->price)->quantity($item->qty));
        }

        Order::create([
            'number' => $this->orderNumber,
            'client_id' => $this->buyer->id,
            'amount' => $this->total,
            'status' => 'Por Cobrar',
            'expires_at'=> date('Ymd'),
            'seller_id' => auth()->user()->id
        ]);

        CartFcd::destroy();
        $invoice = Invoice::make('Nota de Entrega')
            ->sequence($this->orderNumber)
            ->buyer($customer)
            ->addItems($items)
            ->filename($customer->name.date("d-m-Y"))
            ->logo(public_path('images/LOGO_WSG_222.png'))
            ->save();

        return redirect('/productos');
    }

    public function cotizacion()
    {
        $this->updateCart();

        $this->buyer = Client::find($this->buyer);

        $customer = new Buyer([
            'name'          => $this->buyer->name,
            'address'       => $this->buyer->address,
            'custom_fields' => [
                'email' => $this->buyer->email,
                'phone' => $this->buyer->phone
            ],
        ]);

       // dd(CartFcd::content());
        $items = [];
        foreach ($this->content as $item){
            array_push($items, (new InvoiceItem())->title($item->name)->pricePerUnit($item->price)->quantity($item->qty));
        }

        CartFcd::destroy();
        $invoice = Invoice::make('Cotizacion')
            ->buyer($customer)
            ->addItems($items)
            ->filename('Cotizacion'.$customer->name.date("d-m-Y"))
            ->logo(public_path('images/LOGO_WSG_222.png'))
            ->save();

        return redirect('/productos');
    }
}
