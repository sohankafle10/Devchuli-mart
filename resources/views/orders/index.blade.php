@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-extrabold text-blue-900">Orders</h1>
    <hr class="h-1 bg-red-500 mt-2 mb-6">

    <table class="w-full mt-5 border-collapse">
        <thead>
            <tr class="bg-gray-200 text-gray-800">
                <th class="border p-2">Order Date</th>
                <th class="border p-2">Product Image</th>
                <th class="border p-2">Product Name</th>
                <th class="border p-2">Customer Name</th>
                <th class="border p-2">Phone</th>
                <th class="border p-2">Address</th>
                <th class="border p-2">Rate</th>
                <th class="border p-2">Quantity</th>
                <th class="border p-2">Total</th>
                <th class="border p-2">Payment Mode</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($orders as $order)
                <tr class="text-center">
                    <td class="border p-2">{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td class="border p-2">
                        <img src="{{ asset('images/products/' . $order->product->photopath) }}" alt="{{ $order->product->name }}" class="h-24 mx-auto">
                    </td>
                    <td class="border p-2">{{ $order->product->name }}</td>
                    <td class="border p-2">{{ $order->name }}</td>
                    <td class="border p-2">{{ $order->phone }}</td>
                    <td class="border p-2">{{ $order->address }}</td>
                    <td class="border p-2">Rs.{{ number_format($order->price, 2) }}</td>
                    <td class="border p-2">{{ $order->qty }}</td>
                    <td class="border p-2">Rs.{{ number_format($order->qty * $order->price, 2) }}</td>
                    <td class="border p-2">{{ $order->payment_method }}</td>
                    <td class="border p-2">
                        <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold 
                            @if($order->status == 'Pending') bg-yellow-600 text-white
                            @elseif($order->status == 'Processing') bg-blue-600 text-white
                            @elseif($order->status == 'Shipping') bg-amber-600 text-white
                            @elseif($order->status == 'Delivered') bg-green-600 text-white
                            @elseif($order->status == 'Cancelled') bg-red-600 text-white
                            @endif
                        ">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="border p-2 grid gap-2">
                        @if ($order->status == 'Pending')
                            <a href="{{ route('orders.status', [$order->id, 'Processing']) }}" class="bg-blue-600 text-white px-2 py-1 rounded-lg hover:bg-blue-700">Processing</a>
                            <a href="{{ route('orders.status', [$order->id, 'Cancelled']) }}" class="bg-red-600 text-white px-2 py-1 rounded-lg hover:bg-red-700">Cancel</a>
                        @elseif ($order->status == 'Processing')
                            <a href="{{ route('orders.status', [$order->id, 'Shipping']) }}" class="bg-green-600 text-white px-2 py-1 rounded-lg hover:bg-green-700">Shipping</a>
                        @elseif ($order->status == 'Shipping')
                            <a href="{{ route('orders.status', [$order->id, 'Delivered']) }}" class="bg-amber-600 text-white px-2 py-1 rounded-lg hover:bg-amber-700">Delivered</a>
                        @elseif ($order->status == 'Delivered')
                            <span class="text-gray-500">Completed</span>
                        @elseif ($order->status == 'Cancelled')
                            <span class="text-gray-500">Cancelled</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
