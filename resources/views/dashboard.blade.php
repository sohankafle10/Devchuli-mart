@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold text-blue-900">Dashboard</h1>
    <hr class="h-1 bg-red-700">
    <div class="mt-5 grid grid-cols-3 gap-8">
        <div class="bg-blue-100 p-5 shadow rounded-lg">
            <h2 class="text-2xl font-bold text-blue-900">Categories</h2>
            <p>Total Categories:{{ $categories }}</p>
        </div>

        <div class="bg-purple-100 p-5 shadow rounded-lg">
            <h2 class="text-2xl font-bold text-blue-900">Products</h2>
            <p>Total Products:{{ $products }}</p>
        </div>

        <div class="bg-red-100 p-5 shadow rounded-lg">
            <h2 class="text-2xl font-bold text-blue-900">Pending Orders</h2>
            <p>Total PendingOrders:5</p>
        </div>

        <div class="bg-green-100 p-5 shadow rounded-lg">
            <h2 class="text-2xl font-bold text-blue-900">Processing Orders</h2>
            <p>Total ProcessingOrder:5</p>
        </div>

        <div class="bg-pink-100 p-5 shadow rounded-lg">
            <h2 class="text-2xl font-bold text-blue-900">Complete Orders</h2>
            <p>Total CompleteOrder:5</p>
        </div>

        <div class="bg-orange-100 p-5 shadow rounded-lg">
            <h2 class="text-2xl font-bold text-blue-900">Users</h2>
            <p>Total Users:5</p>
        </div>
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <script>
        let chart = document.getElementById('myChart');
        const myChart = new Chart(chart, {
            type: 'pie',
            data: {
                labels: [
                    'Red',
                    'Blue',
                    'Yellow'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            }
        });
    </script>
@endsection
