@extends('layouts.master')
@section('content')
<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
    <input type="hidden" id="amount" name="amount" value="{{$cart->total}}" required>
    <input type="hidden" id="tax_amount" name="tax_amount" value ="0" required>
    <input type="hidden" id="total_amount" name="total_amount" value="{{$cart->total}}" required>
    <input type="hidden" id="transaction_uuid" name="transaction_uuid"required>
    <input type="hidden" id="product_code" name="product_code" value ="EPAYTEST" required>
    <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
    <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
    <input type="hidden" id="success_url" name="success_url" value="{{route('order.store',$cart->id)}}" required>
    <input type="hidden" id="failure_url" name="failure_url" value="https://google.com" required>
    <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
    <input type="hidden" id="signature" name="signature"  required>
    <input  type="submit" value="Pay with eSewa " class="bg-blue-900 text-white px-3 py-1 rounded block w-32 mx-auto ">
    </form>

    <form action="{{route('order.storecod')}}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="cart_id" value="{{$cart->id}}">
        <input type="submit" value="Cash On Delivery" class="bg-green-600 text-white px-2 py-1 rounded block w-50 mx-auto">


    </form>

    @php

        $transaction_uuid = auth()->id().time();
        $totalamount=$cart->total;
        $productcode='EPAYTEST';
        $datastring='total_amount='.$totalamount.',transaction_uuid='. $transaction_uuid.',product_code='.$productcode;
        $secret='8gBm/:&EnhH.1/q';
        $signature= hash_hmac('sha256', $datastring , $secret, true);
        $signature= base64_encode($signature);

    @endphp

    <script>
        document.getElementById('transaction_uuid').value = '{{$transaction_uuid}}';
        document.getElementById('signature').value = '{{$signature}}';


    </script>
@endsection
