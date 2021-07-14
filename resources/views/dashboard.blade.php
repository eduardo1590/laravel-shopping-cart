<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Caja') }}
        </h2>
    </x-slot>

    <div class="flex">
        <div class="flex flex-wrap justify-between w-3/4">
            @foreach ($products as $product)
                <livewire:product-card :product='$product' />
            @endforeach
        </div>
    </div>
</x-app-layout>
