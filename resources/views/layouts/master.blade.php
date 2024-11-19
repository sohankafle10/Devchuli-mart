<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Devchuli Mart</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('images/devchulimart-removebg-preview.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
    @include('layouts.alert')

    <!-- Top Bar -->
    <div class="flex flex-wrap justify-between items-center px-6 sm:px-16 py-2 bg-purple-700 text-white">
        <!-- Social Media Icons -->
        <div class="flex space-x-4 mb-2 sm:mb-0">
            <a href="https://www.facebook.com/sohan.kafle.3" target="_blank" class="text-white text-2xl hover:text-orange-300 transition-transform transform hover:scale-110">
                <i class="ri-facebook-fill"></i>
            </a>
            <a href="https://twitter.com" target="_blank" class="text-white text-2xl hover:text-orange-300 transition-transform transform hover:scale-110">
                <i class="ri-twitter-fill"></i>
            </a>
            <a href="https://www.instagram.com/sohankafle14/" target="_blank" class="text-white text-2xl hover:text-orange-300 transition-transform transform hover:scale-110">
                <i class="ri-instagram-fill"></i>
            </a>
            <a href="https://youtube.com" target="_blank" class="text-white text-2xl hover:text-orange-300 transition-transform transform hover:scale-110">
                <i class="ri-youtube-fill"></i>
            </a>
        </div>
        <!-- Contact Info -->
        <p class="text-lg sm:text-base">Call us: 9869464140</p>
    </div>

    <!-- Navigation Bar -->
    <nav class="shadow bg-white px-16 py-4 mb-10 h-16 flex justify-between font-semibold text-xl items-center sticky top-0 z-40">
        <img src="{{ asset('images/devchulimart-removebg-preview.png') }}" alt="" class="h-16">

        <!-- Search Form -->
        <form action="{{route('search')}}" method="GET">
            <input type="search" id="" class="border border-gray-300 rounded-lg px-16 py-2" placeholder="Search" name="search" value="{{request()->query('search')}}">
            <button type="submit" class="bg-orange-700 text-white rounded-lg px-4 py-2 hover:bg-orange-800">Search</button>
        </form>

        <!-- Links -->
        <div class="flex gap-4">
            <a href="{{ route('home') }}" class="hover:text-purple-700">Home</a>
            @php
                $categories = App\Models\Categories::orderBy('priority')->get();
            @endphp

            @foreach ($categories as $category)
                <a href="{{ route('categoryproduct', $category->id) }}" class="hover:text-purple-700">{{ $category->name }}</a>
            @endforeach

            <!-- Auth Section -->
            @auth
                <div class="relative group">
                    <!-- Profile Picture -->
                    <div class="relative inline-block">
                        @if (auth()->user()->profilepicture)
                            <img class="object-cover w-10 h-10 rounded-full cursor-pointer" src="{{ asset('images/profilepictures/' . auth()->user()->profilepicture) }}">
                        @else
                            <div class="flex items-center justify-center w-10 h-10 text-white bg-purple-700 rounded-full cursor-pointer">
                                <span class="font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>
                    <!-- Dropdown Menu -->
                    <div class="absolute hidden group-hover:block top-8 -right-10 bg-white shadow w-32 rounded-lg">
                        <a href="{{route('mycart')}}" class="block hover:bg-gray-200 p-4 py-2 rounded-md">My Cart</a>
                        <a href="{{route('myorder')}}" class="block hover:bg-gray-200 p-4 py-2 rounded-md">My Order</a>
                        <a href="{{route('profile.edit')}}" class="block hover:bg-gray-200 p-4 py-2 rounded-md">My Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block py-2 hover:bg-gray-200 p-4 rounded-md w-full text-left">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:text-purple-700">Login</a>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="text-white text-center bg-purple-700 lg:text-left mt-10">
        <div class="flex items-center justify-center border-b-2 border-orange-300 p-6 lg:justify-between">
            <div class="me-12 hidden lg:block">
                <span>"Stay connected with us through our social media platforms:"</span>
            </div>
            <div class="flex justify-center">
                <a href="https://www.facebook.com/sohan.kafle.3" class="me-6 text-xl hover:text-orange-300"><i class="ri-facebook-fill"></i></a>
                <a href="#!" class="me-6 text-xl hover:text-orange-300"><i class="ri-twitter-fill"></i></a>
                <a href="https://www.instagram.com/sohankafle14/" target="_blank" class="me-6 text-xl hover:text-orange-300"><i class="ri-instagram-fill"></i></a>
                <a href="+977 9869464140" target="_blank" class="me-6 text-xl hover:text-orange-300"><i class="ri-whatsapp-fill"></i></a>
            </div>
        </div>

        <div class="mx-6 py-10 text-center md:text-left">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                <!-- About Section -->
                <div>
                    <h6 class="mb-4 flex items-center justify-center font-semibold uppercase text-white md:justify-start">Devchuli Mart</h6>
                    <p>"Your One-Stop Shop for Quality and Convenience!"</p>
                </div>
                <!-- Products Section -->
                <div>
                    <h6 class="mb-4 font-semibold uppercase text-white">Products</h6>
                    @php
                        $categories = App\Models\Categories::all();
                    @endphp
                    @foreach ($categories as $category)
                        <p class="mb-4"><a href="{{route('categoryproduct', $category->id)}}" class="hover:text-orange-300">{{ $category->name }}</a></p>
                    @endforeach
                </div>
                <!-- Useful Links -->
                <div>
                    <h6 class="mb-4 font-semibold uppercase text-white">Useful Links</h6>
                    <p class="mb-4"><a href="#!" class="hover:text-orange-300">Pricing</a></p>
                    <p class="mb-4"><a href="#!" class="hover:text-orange-300">Settings</a></p>
                    <p class="mb-4"><a href="#!" class="hover:text-orange-300">Orders</a></p>
                    <p><a href="#!" class="hover:text-orange-300">Help</a></p>
                </div>
                <!-- Contact Section -->
                <div>
                    <h6 class="mb-4 font-semibold uppercase text-white">Contact</h6>
                    <p class="mb-4">Devchuli-13, Nawalparasi</p>
                    <p class="mb-4">sohankafle33@gmail.com</p>
                    <p class="mb-4">9869464140</p>
                    <p>078-21556</p>
                </div>
            </div>
        </div>

        <div class="bg-purple-900 p-6 text-center">
            <span>© 2024 Copyright: </span>
            <a href="#" class="font-semibold text-white hover:text-orange-300">Devchuli Mart</a>
        </div>
    </footer>
</body>

</html>
