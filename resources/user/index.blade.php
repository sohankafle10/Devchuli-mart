@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-extrabold text-blue-900">Users</h1>
    <hr class="h-1 bg-red-500">

    <table class="w-full mt-5">
        <tr>
            <th class="border p-2 bg-gray-200">ID</th>
            <th class="border p-2 bg-gray-200">Profile Image</th>
            <th class="border p-2 bg-gray-200">Name</th>
            <th class="border p-2 bg-gray-200">Email</th>
            <th class="border p-2 bg-gray-200">Phone</th>
            <th class="border p-2 bg-gray-200">Address</th>
            <th class="border p-2 bg-gray-200">Created At</th>
            <th class="border p-2 bg-gray-200">Action</th>
        </tr>

        @foreach ($users as $user)
            <tr class="text-center">
                <td class="border p-2">{{ $user->id }}</td>
                <td class="border p-2">
                    <img src="{{ asset('images/users/' . $user->profile_image) }}" alt="Profile"
                        class="h-16 w-16 rounded-full mx-auto">
                </td>
                <td class="border p-2">{{ $user->name }}</td>
                <td class="border p-2">{{ $user->email }}</td>
                <td class="border p-2">{{ $user->phone ?? 'N/A' }}</td>
                <td class="border p-2">{{ $user->address ?? 'N/A' }}</td>
                <td class="border p-2">{{ $user->created_at->format('Y-m-d') }}</td>
                <td class="border p-2 grid gap-2">
                    <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-600 text-white px-2 py-1 rounded-lg">Edit</a>
                    <a href="{{ route('users.delete', $user->id) }}" class="bg-red-600 text-white px-2 py-1 rounded-lg" 
                       onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
