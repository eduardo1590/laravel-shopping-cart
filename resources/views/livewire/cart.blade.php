<div>
    <div class="w-2/3 mx-auto">
    <div class="col-span-2 sm:col-span-4">
        <label for="client" class="block text-sm font-medium text-gray-700">Cliente</label>
        <select wire:model.defer="buyer" id="client" name="client" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        @foreach($clients as $client)
        <option value="{{$client->id}}">{{$client->name}}</option>
        @endforeach
        </select>
    </div>  
        <div class="bg-white shadow-md rounded my-6">
        @if ($content->count() > 0)
                <table class="text-left w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Nombre</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Cantidad</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Precio</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Sub-Total</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($content as $id => $item)
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $item->name}}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                <button class="text-sm p-2 border-2 rounded border-red-200 hover:border-red-300 bg-red-200 hover:bg-red-300" wire:click="updateCartItem('{{ $id }}', '-')"> - </button>
                                {{ $item->qty }}
                                <button class="text-sm p-2 border-2 rounded border-green-200 hover:border-green-300 bg-green-200 hover:bg-green-300" wire:click="updateCartItem('{{ $id }}', '+')"> + </button>
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">${{ $item->price }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">${{ $item->qty * $item->price }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    <a wire:click="removeFromCart('{{ $id }}')" class="text-blue-600 font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark cursor-pointer">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <td class="py-4 px-6 border-b border-grey-light"></td>
                        <td class="py-4 px-6 border-b border-grey-light"></td>
                        <td class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">TOTAL:</td>
                        <td class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">${{$total}}</td>
                        <td class="py-4 px-6 border-b border-grey-light">
                        </tr>
                    </tfoot>
                </table>

                <div class="text-right w-full p-6">
                    <button wire:click="cotizacion()" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Cotizacion
                    </button>
                    <button wire:click="checkout()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Confirmar
                    </button>
                </div>
            @else
                <div class="text-center w-full border-collapse p-6">
                    <span class="text-lg">¡Your cart is empty!</span>
                </div>
            @endif
        </div>
    </div>
</div>