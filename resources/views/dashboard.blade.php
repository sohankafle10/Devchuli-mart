@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <!-- Dashboard Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900">Dashboard</h1>
        <hr class="mt-4 border-t border-gray-300">
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Categories -->
        <div class="flex items-center justify-between bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-lg shadow-md hover:shadow-lg">
            <div>
                <h2 class="text-2xl font-semibold">Categories</h2>
                <p class="text-lg mt-2">Total: <span class="font-bold">{{ $categories }}</span></p>
            </div>
            <i class="fas fa-folder text-4xl"></i>
        </div>

        <!-- Products -->
        <div class="flex items-center justify-between bg-gradient-to-r from-purple-500 to-purple-700 text-white p-6 rounded-lg shadow-md hover:shadow-lg">
            <div>
                <h2 class="text-2xl font-semibold">Products</h2>
                <p class="text-lg mt-2">Total: <span class="font-bold">{{ $products }}</span></p>
            </div>
            <i class="fas fa-boxes text-4xl"></i>
        </div>

        <!-- Pending Orders -->
        <div class="flex items-center justify-between bg-gradient-to-r from-red-500 to-red-700 text-white p-6 rounded-lg shadow-md hover:shadow-lg">
            <div>
                <h2 class="text-2xl font-semibold">Pending Orders</h2>
                <p class="text-lg mt-2">Total: <span class="font-bold">{{ $pending_order }}</span></p>
            </div>
            <i class="fas fa-clock text-4xl"></i>
        </div>

        <!-- Processing Orders -->
        <div class="flex items-center justify-between bg-gradient-to-r from-green-500 to-green-700 text-white p-6 rounded-lg shadow-md hover:shadow-lg">
            <div>
                <h2 class="text-2xl font-semibold">Processing Orders</h2>
                <p class="text-lg mt-2">Total: <span class="font-bold">{{ $processing_order }}</span></p>
            </div>
            <i class="fas fa-sync-alt text-4xl"></i>
        </div>

        <!-- Complete Orders -->
        <div class="flex items-center justify-between bg-gradient-to-r from-yellow-500 to-yellow-700 text-white p-6 rounded-lg shadow-md hover:shadow-lg">
            <div>
                <h2 class="text-2xl font-semibold">Complete Orders</h2>
                <p class="text-lg mt-2">Total: <span class="font-bold">{{ $completed_order }}</span></p>
            </div>
            <i class="fas fa-check-circle text-4xl"></i>
        </div>

        <!-- Users -->
        <div class="flex items-center justify-between bg-gradient-to-r from-pink-500 to-pink-700 text-white p-6 rounded-lg shadow-md hover:shadow-lg">
            <div>
                <h2 class="text-2xl font-semibold">Users</h2>
                <p class="text-lg mt-2">Total: <span class="font-bold">{{ $users }}</span></p>
            </div>
            <i class="fas fa-users text-4xl"></i>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="my-8">
        <h2 class="text-2xl font-semibold text-gray-900">Item Overview</h2>
        <canvas id="dashboardChart" class="w-full h-80"></canvas>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('dashboardChart');
        
        // Only initialize the chart if it doesn't already exist
        if (ctx && !ctx.chart) {
            var dashboardChart = new Chart(ctx, {
                type: 'line', // Change the chart type to 'line'
                data: {
                    labels: ['Categories', 'Products', 'Pending Orders', 'Processing Orders', 'Complete Orders', 'Users'],
                    datasets: [{
                        label: 'Total Items',
                        data: [
                            {{ $categories }},
                            {{ $products }},
                            {{ $pending_order }},
                            {{ $processing_order }},
                            {{ $completed_order }},
                            {{ $users }}
                        ],
                        fill: false, // To make it a simple line without filling
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
</script>
