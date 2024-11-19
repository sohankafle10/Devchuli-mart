@extends('layouts.master')

@section('content')
    <div class="container px-4 py-8 mx-auto">
        <h1 class="px-4 mb-6 text-2xl text-green-700 font-bold border-l-4 border-green-700">My Orders</h1>

        @if ($orders->isEmpty())
            <div class="p-4 mb-6 text-green-700 bg-green-100 border-l-4 border-green-700" role="alert">
                <p>You have no orders.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead>
                        <tr class="text-sm text-gray-700 uppercase bg-gray-100">
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Product</th>
                            <th class="px-4 py-3 text-left">Quantity</th>
                            <th class="px-4 py-3 text-left">Price</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Payment Method</th>
                            <th class="px-4 py-3 text-left">Order Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-3">{{ $order->id }}</td>
                                <td class="px-4 py-3">
                                    @if ($order->product)
                                        {{ $order->product->name }}
                                    @else
                                        <span class="text-red-500">Product not available</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $order->qty }}</td>
                                <td class="px-4 py-3">Rs.{{ number_format($order->price, 2) }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                        {{ $order->status == 'Pending'
                                            ? 'bg-yellow-600 text-white'
                                            : ($order->status == 'Shipping'
                                                ? 'bg-blue-200 text-blue-800'
                                                : ($order->status == 'Processing'
                                                    ? 'bg-orange-200 text-orange-800'
                                                    : ($order->status == 'Completed'
                                                        ? 'bg-green-200 text-green-800'
                                                        : 'bg-red-200 text-red-800'))) }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">{{ $order->payment_method }}</td>
                                <td class="px-4 py-3">{{ $order->created_at->format('d-m-Y') }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>


@endsection

