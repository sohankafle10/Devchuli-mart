@extends('layouts.master')

@section('content')
    <div class="px-16 py-6">
        <div class="border-l-4 border-blue-900 pl-4 mb-6">
            <h1 class="text-3xl font-extrabold text-gray-800">Search Results</h1>
            <p class="text-gray-600">Browse through our search results</p>
        </div>

        @if($products->isEmpty())
            <div class="flex justify-center items-center h-64">
                <h1 class="text-xl font-semibold text-gray-700">No Products Found</h1>
            </div>
        @else
            <div class="grid grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <a href="{{ route('viewproduct', $product->id) }}" class="transform hover:-translate-y-2 transition duration-300">
                        <div class="border rounded-lg bg-white shadow-md hover:shadow-lg overflow-hidden">
                            <img src="{{ asset('images/products/' . $product->photopath) }}" alt="{{ $product->name }}"
                                class="h-64 w-full object-cover">
                            <div class="p-4">
                                <h1 class="text-lg font-bold text-gray-900">{{ $product->name }}</h1>
                                @if ($product->discounted_price)
                                    <p class="text-blue-900 font-bold text-lg">Rs. {{ $product->discounted_price }}
                                        <span class="line-through text-sm text-red-600">Rs. {{ $product->price }}</span>
                                    </p>
                                @else
                                    <p class="text-blue-900 font-bold text-lg">Rs. {{ $product->price }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        <div class=" mt-10">
            <div class="border-l-4 border-blue-900 pl-4 mb-4">
                <h1 class="text-2xl font-extrabold text-gray-800">Related Products</h1>
            </div>
            <div class="grid grid-cols-4 gap-6">
                @foreach ($relatedproducts as $rproduct)
                    <a href="{{ route('viewproduct', $rproduct->id) }}" class="transform hover:-translate-y-2 transition duration-300">
                        <div class="border rounded-lg bg-white shadow-md hover:shadow-lg overflow-hidden">
                            <img src="{{ asset('images/products/' . $rproduct->photopath) }}" alt="{{ $rproduct->name }}"
                                class="h-64 w-full object-cover rounded-t-lg">
                            <div class="p-4">
                                <h1 class="text-lg font-bold text-gray-900">{{ $rproduct->name }}</h1>
                                @if ($rproduct->discounted_price)
                                    <p class="text-lg font-bold text-blue-900">Rs. {{ $rproduct->discounted_price }}
                                        <span class="line-through font-semibold text-sm text-red-600">Rs. {{ $rproduct->price }}</span>
                                    </p>
                                @else
                                    <p class="text-lg font-bold text-blue-900">Rs. {{ $rproduct->price }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
