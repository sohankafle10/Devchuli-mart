<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-slate-600">
    @include('layouts.alert')
    <div class='flex'>
        <nav class="w-56 h-screen shadow-lg bg-gray-100">
            <img src="{{ asset('images/devchulimart-removebg-preview.png') }}" alt="" class="w-32 mx-auto mt-4">
            <ul class="mt-8">
                <li>
                    <a href="{{ route('dashboard') }}" 
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl @if (Route::is('dashboard'))bg-green-700 text-white hover:bg-green-600 @endif">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('category.index') }}" 
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl @if (Route::is('category.*'))bg-green-700 text-white hover:bg-green-600 @endif">
                        <i class="fas fa-folder mr-2"></i> Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('product.index') }}" 
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl @if (Route::is('product.*'))bg-green-700 text-white hover:bg-green-600 @endif">
                        <i class="fas fa-boxes mr-2"></i> Products
                    </a>
                </li>
                <li>
                    <a href="{{ route('orders.index') }}" 
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl @if (Route::is('orders.*'))bg-green-700 text-white hover:bg-green-600 @endif">
                        <i class="fas fa-shopping-cart mr-2"></i> Orders
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.show') }}" 
                        class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl @if (Route::is('dashboard.*'))bg-green-700 text-white hover:bg-green-600 @endif">
                        <i class="fas fa-users mr-2"></i> Users
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                            class="block hover:bg-gray-200 p-4 rounded-lg font-bold text-xl w-full text-left" onclick="return confirm('Are you sure to logout?')">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="p-4 flex-1">
            @yield('content')
        </div>
    </div>
</body>

</html>
