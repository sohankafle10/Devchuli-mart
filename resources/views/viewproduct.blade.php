@extends('layouts.master')

@section('content')
    <div class="mt-5 grid grid-cols-4 gap-6 px-16">
        <div>
            <img src="{{ asset('images/products/' . $product->photopath) }}" alt=""
                class="h-72 w-full object-cover rounded-lg">
        </div>

        <div class="col-span-2 border-x  px-4">
            <h2 class="font-bold text-4xl">{{ $product->name }}</h2>

            <p class="text-blue-900 font-bold text-2xl">

                @if ($product->discounted_price != '')
                    Rs.{{ $product->discounted_price }}
                    <span class="line-through font-semibold text-sm text-red-600">Rs.{{ $product->price }}</span>
                @else
                    Rs.{{ $product->price }}
                @endif
            </p>
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="flex mt-10">
                    <button class="bg-gray-200 px-4 block py-2 cursor-pointer" onclick="return dec()">-</button>
                    <input type="text" class="w-12 text-center border-none bg-gray-100" value="1" id="qty"
                        name="qty" readonly>
                    <button class="px-4 bg-gray-200 block py-2 cursor-pointer" onclick=" return inc()">+</button>
                </div>

                <p class="text-gray-400">In Stock: {{ $product->stock }}</p>

                <button type="submit" class="bg-blue-900 text-white px-4 py-2 mt-5 rounded">Add to Cart</button>
            </form>
        </div>

        <div class="text-gray-700 px-2">
            <p class="mb-2"> <i class="ri-truck-fill"></i>Delivery within 5 days</p>
            <p class="mb-2">7 days return policy</p>
            <p class="mb-2">Cash on delivery available</p>

        </div>
    </div>

    <div class="mt-10 px-16">
        <h2 class="font-bold text-2xl">About Product</h2>
        <p class="text-gray-500">{{ $product->description }}</p>

    </div>

    <div class="px-16 mt-10">
        <div class=" border-l-4 border-blue-900 pl-2">
            <h1 class="text-2xl font-bold">Related Product</h1>

        </div>
        <div class="grid grid-cols-4 gap-10 mt-5">
            @foreach ($relatedproducts as $rproduct)
                <a href="{{ route('viewproduct', $rproduct->id) }}">
                    <div class="border rounded-lg bg-gray-100 hover:-translate-y-2 duration-300 shadow hover:shadow-lg">
                        <img src="{{ asset('images/products/' . $rproduct->photopath) }}" alt=""
                            class="h-64 w-full object-cover rounded-t-lg">
                        <div class="p-4">
                            <h1 class="text-lg font-bold">{{ $rproduct->name }}</h1>
                            <p class="text-blue-900 font-bold text-2xl">

@if ($product->discounted_price != '')
    Rs.{{ $product->discounted_price }}
    <span class="line-through font-semibold text-sm text-red-600">Rs.{{ $product->price }}</span>
@else
    Rs.{{ $product->price }}
@endif
</p>
                        </div>
                    </div>

                </a>
            @endforeach
        </div>
    </div>





    <script>
        function inc() {
            let qty = document.getElementById('qty');

            if (parseInt(qty.value) < {{ $product->stock }}) {

                qty.value = parseInt(qty.value) + 1;
                return false;
            }
        }

        function dec() {
            let qty = document.getElementById('qty');

            if (parseInt(qty.value) > 1) {

                qty.value = parseInt(qty.value) - 1;
                return false;
            }
        }
    </script>
@endsection
