@extends('layouts.app')
@section('content')
    <h1 class="text-4xl font-extrabold text-blue-900">Orders</h1>
    <hr class="h-1 bg-red-500">



    <table class="w-full mt-5">
        <tr>
            <th class="border p-2 bg-gray-200">Order Date</th>
            <th class="border p-2 bg-gray-200">Product Image</th>
            <th class="border p-2 bg-gray-200">Product name</th>
            <th class="border p-2 bg-gray-200">Customer name</th>
            <th class="border p-2 bg-gray-200">Phone</th>
            <th class="border p-2 bg-gray-200">Address</th>
            <th class="border p-2 bg-gray-200">Rate</th>
            <th class="border p-2 bg-gray-200">Quantity</th>
            <th class="border p-2 bg-gray-200">Total</th>
            <th class="border p-2 bg-gray-200">Payment Mode</th>
            <th class="border p-2 bg-gray-200">Status</th>
            <th class="border p-2 bg-gray-200">Action</th>
        </tr>

        @foreach ($orders as $order)
            <tr class="text-center">
                <td class="border p-2">{{ $order->created_at }}</td>
                <td class="border p-2">
                    <img src="{{ asset('images/products/' . $order->product->photopath) }}" alt=""
                        class="h-24 mx-auto">
                </td>
                <td class="border p-2">{{ $order->product->name }}</td>
                <td class="border p-2">{{ $order->name }}</td>
                <td class="border p-2">{{ $order->phone }}</td>
                <td class="border p-2">{{ $order->address }}</td>
                <td class="border p-2">{{ $order->price }}</td>
                <td class="border p-2">{{ $order->qty }}</td>
                <td class="border p-2">{{ $order->qty * $order->price }}</td>
                <td class="border p-2">{{ $order->payment_method }}</td>
                <td class="border p-2">{{ $order->status }}</td>
                <td class="border p-2 grid gap-2">
                    <a href="{{route('orders.status',[$order->id,'Pending'])}}" class="bg-blue-600 text-white px-2 py-1 rounded-lg">Pending</a>
                    <a href="{{route('orders.status',[$order->id,'Processing'])}}" class="bg-green-600 text-white px-2 py-1 rounded-lg">Processing</a>
                    <a href="{{route('orders.status',[$order->id,'Shipping'])}}" class="bg-amber-600 text-white px-2 py-1 rounded-lg">Shipping</a>
                    <a href="{{route('orders.status',[$order->id,'Delivered'])}}" class="bg-red-600 text-white px-2 py-1 rounded-lg">Delivered</a>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
