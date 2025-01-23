@extends('layouts.master')
@section('content')


@if(Route::currentRouteName() == 'home')
<div class="relative w-full h-[600px]">
    <img src="{{ asset('images/banner.png') }}" alt="Banner" class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white text-center">
        <h1 class="text-4xl font-bold mb-4">Welcome to Devchuli Mart</h1>
        <p class="mb-6">Discover More at Our Mart!</p>
        <a href="#searchproduct" class="bg-sky-300 text-white px-6 py-3 rounded-md hover:bg-sky-400">
            Explore Our Product
        </a>
    </div>
</div>
@endif
<div class="px-16">
    <div class=" border-l-4 border-green-700 p-2">
        <h1 class="text-2xl font-bold " id='searchproduct'>Our Recent Products</h1>
        <p> Every thing at one place</p>
    </div>
    <div class="grid grid-cols-4 gap-10 mt-5">
        @foreach ( $products as $product)
        <a href="{{route('viewproduct',$product->id)}}">
            <div class="border rounded-lg bg-gray-100 hover:-translate-y-2 duration-300 shadow hover:shadow-lg">
                <img src="{{asset('images/products/'.$product->photopath)}}" alt="" class="h-64 w-full object-cover rounded-t-lg">
                <div class="p-4">
                    <h1 class="text-lg font-bold">{{$product->name}}</h1>
                    @if ($product->discounted_price !='')
                    <p class="text-lg font-bold text-blue-900"> Rs. {{$product->discounted_price}}
                        <span class="line-through font-semibold text-lg  font-bold text-red-600">Rs.{{$product->price}} </span>
                    </p>
                    @else
                    <p class="text-lg font-bold text-blue-900">Rs.{{$product->price}} </p>
                    @endif
                </div>
            </div>

        </a>
        @endforeach
    </div>
</div>
@endsection