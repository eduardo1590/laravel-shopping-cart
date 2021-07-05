<div class="">
  <div class="flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="w-1/3 bg-cover" style="background-image: url('http://lorempixel.com/400/200/')">
    </div> 
    <div class="w-2/3 p-4">
      <h1 class="text-gray-900 font-bold text-2xl">{{$product->name}}</h1>
      <p class="mt-2 text-gray-600 text-sm">{{$product->description}}</p>
      <div class="flex item-center justify-between mt-3">
        <h1 class="text-gray-700 font-bold text-xl">$220</h1>
        <button class="px-3 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded">Add to Card</button>
      </div>
    </div>
  </div>
</div>