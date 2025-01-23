@extends('layouts.master')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-purple-700 mb-4">Contact Us</h1>
    <p class="mb-6 text-gray-600">We'd love to hear from you! Please fill out the form below to get in touch with us.</p>

    <form action="#" method="POST" class="bg-white shadow rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Your Name</label>
            <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Enter your name">
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Your Email</label>
            <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Enter your email">
        </div>
        <div class="mb-4">
            <label for="message" class="block text-gray-700 font-bold mb-2">Your Message</label>
            <textarea id="message" name="message" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Enter your message"></textarea>
        </div>
        <button type="submit" class="bg-purple-700 text-white px-6 py-2 rounded-lg hover:bg-purple-800">
            Send Message
        </button>
    </form>
</div>
@endsection
