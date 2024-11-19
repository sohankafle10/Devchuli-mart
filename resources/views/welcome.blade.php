@extends('layouts.master')
@section('content')
<div class="px-16">
<div class=" border-l-4 border-green-700 pl-2">
    <h1 class="text-2xl font-bold">Our Recent Products</h1>
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
