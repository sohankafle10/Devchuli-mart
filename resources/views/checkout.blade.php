@extends('layouts.master')

@section('content')

<!-- Center the Product Information Section -->
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Product Info Card -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Product Information</h2>
            <div class="flex flex-wrap md:flex-nowrap items-center gap-6">
                <!-- Product Image -->
                <img src="{{ asset('images/products/'.$cart->product->photopath) }}" alt="Product Image" class="w-48 h-48 rounded-lg shadow-md">
                
                <!-- Product Details -->
                <div class="space-y-3">
                    <p class="text-lg"><strong>Product Name:</strong> {{ $cart->product->name }}</p>
                    <p class="text-gray-600"><strong>Description:</strong> {{ $cart->product->description }}</p>
                    @if($cart->product->discounted_price)
                        <p class="text-lg text-orange-600"><strong>Price:</strong> <span class="line-through">RS. {{ number_format($cart->product->price, 2) }}</span> RS. {{ number_format($cart->product->discounted_price, 2) }}</p>
                    @else
                        <p class="text-lg text-orange-600"><strong>Price:</strong> RS. {{ number_format($cart->product->price, 2) }}</p>
                    @endif
                    <!-- quantity -->
                    <p class="text-lg text-orange-600"><strong>Quantity:</strong> {{ $cart->qty }}</p>
                    <p class="text-gray-700"><strong>Total Amount:</strong> RS. {{ number_format($cart->total, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Options -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Choose Payment Method</h3>
            <div class="flex flex-wrap gap-6 justify-center">
                <!-- eSewa Payment Form -->
                <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" class="w-full md:w-1/2 lg:w-1/3 bg-blue-100 shadow-md rounded-lg p-6">
                    @csrf
                    <input type="hidden" id="amount" name="amount" value="{{ $cart->total }}" required>
                    <input type="hidden" id="tax_amount" name="tax_amount" value="0" required>
                    <input type="hidden" id="total_amount" name="total_amount" value="{{ $cart->total }}" required>
                    <input type="hidden" id="transaction_uuid" name="transaction_uuid" required>
                    <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
                    <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
                    <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
                    <input type="hidden" id="success_url" name="success_url" value="{{ route('order.store', $cart->id) }}" required>
                    <input type="hidden" id="failure_url" name="failure_url" value="https://google.com" required>
                    <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
                    <input type="hidden" id="signature" name="signature" required>
                    <input type="submit" value="Pay with eSewa" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                </form>

                <!-- Cash On Delivery Form -->
                <form action="{{ route('order.storecod') }}" method="POST" class="w-full md:w-1/2 lg:w-1/3 bg-green-100 shadow-md rounded-lg p-6">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                    <input type="submit" value="Cash On Delivery" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">
                </form>
            </div>
        </div>
    </div>
</div>

@php
    $transaction_uuid = auth()->id().time();
    $totalamount = $cart->total;
    $productcode = 'EPAYTEST';
    $datastring = 'total_amount='.$totalamount.',transaction_uuid='.$transaction_uuid.',product_code='.$productcode;
    $secret = '8gBm/:&EnhH.1/q';
    $signature = hash_hmac('sha256', $datastring, $secret, true);
    $signature = base64_encode($signature);
@endphp

<script>
    document.getElementById('transaction_uuid').value = '{{$transaction_uuid}}';
    document.getElementById('signature').value = '{{$signature}}';
</script>

@endsection
