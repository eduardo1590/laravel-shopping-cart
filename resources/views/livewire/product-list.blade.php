<div class="grid grid-cols-3 grid-rows-3 gap-4">
    @foreach($products as $product)
        <x-product-card :product="$product" />
    @endforeach     
</div>
