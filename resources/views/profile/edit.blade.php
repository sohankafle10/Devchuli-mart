<!-- @extends(auth()->user()->role == 'admin' ? 'layouts.app' : 'layouts.master') -->
@extends('layouts.master')
@section('content')
<div class="container mx-auto">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="text-3xl font-bold text-red-900 ">Profile Information</div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Name:</strong>
                        <p class="text-muted">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <p class="text-muted">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Phone:</strong>
                        <p class="text-muted">{{ auth()->user()->phone }}</p>
                    </div>
                    <div class="mb-3">
                        <strong>Address:</strong>
                        <p class="text-muted">{{ auth()->user()->address }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




@endsection