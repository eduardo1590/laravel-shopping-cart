<div>
<div class="w-full flex justify-center mb-3">
    <input wire:model="search" type="text" class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Filtra productos por codigo...">
</div>

<div class="grid grid-cols-3 grid-rows-3 gap-4">
    @foreach($products as $product)
    <livewire:product-card :product='$product' :key="$product->id" />
    @endforeach     
</div>

    <div class="w-full flex justify-center pb-6 mt-3">
        {{ $products->links() }}
    </div>

    @push('js')
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Livewire.on('productAddedToCart', () =>{
           Toast.fire({
            icon: 'success',
            title: 'Producto agregado al carrito'
            })
        })
    </script>
    @endpush
</div>
