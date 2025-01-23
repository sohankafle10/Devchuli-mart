@extends('layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <!-- Form Container -->
        <div class="w-full sm:w-96 md:w-3/4 lg:w-1/3 bg-white shadow-xl rounded-xl p-6 space-y-6">

            <!-- Logo and Heading -->
            <div class="text-center">
                <img src="{{ asset('images/devchulimart-removebg-preview.png') }}" alt="Devchuli Mart Logo" class="mx-auto w-24 mb-4">
                <h2 class="text-2xl font-semibold text-[#eb456f]">Create Your Account</h2>
                
            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register')}}" enctype="multipart/form-data">
                @csrf

                <!-- Profile Picture -->
                <div class="mb-4">
                    <label for="profilepicture" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <input id="profilepicture" type="file" name="profilepicture" value="{{ old('profilepicture') }}"
                        class="mt-1 block w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-2"
                        required>
                    @error('profilepicture')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Full Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                        class="mt-1 block w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-2" required>
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" 
                        class="mt-1 block w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-2" required>
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                        class="mt-1 block w-full p-3 text-sm border border-gray-300 rounded-md" required>
                    @error('phone')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input id="address" type="text" name="address" value="{{ old('address') }}"
                        class="mt-1 block w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-2" required>
                    @error('address')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender -->
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <div class="flex items-center space-x-4">
                        <label for="male" class="inline-flex items-center space-x-2">
                            <input type="radio" name="gender" value="male"
                                class="h-4 w-4 text-[#eb456f] focus:ring-[#eb456f]" required>
                            <span class="text-sm text-gray-700">Male</span>
                        </label>
                        <label for="female" class="inline-flex items-center space-x-2">
                            <input type="radio" name="gender" value="female"
                                class="h-4 w-4 text-[#eb456f] focus:ring-[#eb456f]" required>
                            <span class="text-sm text-gray-700">Female</span>
                        </label>
                        <label for="other" class="inline-flex items-center space-x-2">
                            <input type="radio" name="gender" value="other"
                                class="h-4 w-4 text-[#eb456f] focus:ring-[#eb456f]" required>
                            <span class="text-sm text-gray-700">Other</span>
                        </label>
                    </div>
                    @error('gender')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password"
                        class="mt-1 block w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-2" required>
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="mt-1 block w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-2" required>
                    @error('password_confirmation')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit"
                        class="w-full py-3 bg-[#eb456f] text-white text-sm font-semibold rounded-lg hover:bg-[#eb456f] focus:outline-none focus:ring-2 focus:ring-[#eb456f]">
                        Register
                    </button>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? <a href="{{ route('login') }}"
                            class="text-[#eb456f] hover:text-[#eb456f]">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
