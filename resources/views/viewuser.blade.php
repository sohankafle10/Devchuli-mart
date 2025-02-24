@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-4">Users Data</h1>
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Join Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr class="hover:bg-gray-100">
            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
            <td class="py-2 px-4 border-b">{{ $user->created_at }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection