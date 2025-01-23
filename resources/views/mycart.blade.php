@extends('layouts.master')
@section('content')
    <div class="px-16">
        <div class="border-l-4 border-green-700 pl-2">
            <h1 class="text-2xl font-bold">My Cart</h1>
            <p>Products in Cart</p>
        </div>

        @if ($carts->isEmpty())
            <!-- Message if the cart is empty -->
            <div class="mt-5 text-center">
                <p class="text-lg font-semibold text-gray-600">Your cart is empty!</p>
                <a href="{{ route('home') }}" class="text-white bg-orange-700 px-4 py-2 rounded-lg hover:bg-orange-800 mt-4 inline-block">
                    Continue Shopping
                </a>
            </div>
        @else
            <!-- Cart Table -->
            <table class="w-full mt-5">
                <tr>
                    <th class="border border-gray-300 p-2">Product Image</th>
                    <th class="border border-gray-300 p-2">Product Name</th>
                    <th class="border border-gray-300 p-2">Quantity</th>
                    <th class="border border-gray-300 p-2">Price</th>
                    <th class="border border-gray-300 p-2">Total</th>
                    <th class="border border-gray-300 p-2">Action</th>
                </tr>
                @foreach ($carts as $cart)
                    <tr class="text-center">
                        <td class="border border-gray-100 p-2">
                            <img src="{{ asset('images/products/' . $cart->product->photopath) }}" alt="" class="h-16 mx-auto">
                        </td>
                        <td class="border border-gray-100 p-2">{{ $cart->product->name }}</td>
                        <td class="border border-gray-100 p-2">{{ $cart->qty }}</td>
                        <td class="border border-gray-100 p-2 font-semibold">
                            @if ($cart->product->discounted_price == '')
                                {{ $cart->product->price }}
                            @else
                                {{ $cart->product->discounted_price }}
                                <span class="line-through text-xs text-red-700 block">{{ $cart->product->price }}</span>
                            @endif
                        </td>
                        <td class="border border-gray-100 p-2">{{ $cart->total }}</td>
                        <td class="border border-gray-100 p-2 text-center">
                            <a href="{{ route('checkout', $cart->id) }}" class="bg-green-700 text-white px-2 py-1 rounded-lg">Checkout</a>
                            <a href="{{ route('cart.destroy', $cart->id) }}" class="bg-red-700 text-white px-2 py-1 rounded-lg">Remove</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection
