@extends('layouts.app')
@section('content')

<h1 class="text-4xl font-extrabold text-blue-900">Create Products</h1>
    <hr class="h-1 bg-red-500">

<form action="{{route('product.store')}}" method="POST" class="mt-5" enctype="multipart/form-data">
    @csrf
    <select name="category_id" id="" class="w-full rounded-lg my-2">
        @foreach ($categories as $category)


        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach

    </select>
    <input type="text" placeholder="Enter Product name" name="name" class="w-full rounded-lg my-2 " value="{{old('name')}}">
    @error('name')
    <p class="text-red-600 -mt-2 ">{{$message}}</p>
    @enderror
    <textarea name="description" id="" cols="30" rows="5" placeholder="Enter Product Description" class="w-full rounded-lg my-2">{{old('description')}}</textarea>
    @error('description')
    <p class="text-red-600 -mt-2 ">{{$message}}</p>
    @enderror
    <input type="text" placeholder="Enter Price" name="price" class="w-full rounded-lg my-2 " value="{{old('price')}}">
    @error('price')
    <p class="text-red-600 -mt-2 ">{{$message}}</p>
    @enderror
    <input type="text" placeholder="Enter Discount Price" name="discounted_price" class="w-full rounded-lg my-2 " value="{{old('discounted_price')}}">
    @error('discounted_price')
    <p class="text-red-600 -mt-2 ">{{$message}}</p>
    @enderror
    <input type="text" placeholder="Enter stock" name="stock" class="w-full rounded-lg my-2 " value="{{old('stock')}}">
    @error('stock')
    <p class="text-red-600 -mt-2 ">{{$message}}</p>
    @enderror
    <select name="status" id="" class="w-full rounded-lg my-2">
        <option value="Show">Show</option>
        <option value="Hide">Hide</option>
        </select>
        @error('status')
       <p class="text-red-600 -mt-2 ">{{$message}}</p>
       @enderror
     <input type="file" placeholder="Enter Product Image" name="photopath" class="w-full rounded-lg my-2 " value="{{old('image')}}" >
     @error('image')
    <p class="text-red-600 -mt-2 ">{{$message}}</p>
     @enderror

     <div class="flex mt-4 justify-center gap-4">
        <input type="submit" value="Add category" class="bg-blue-600 text-white px-5 py-3 rounded-lg curser-pointer">
        <a href="{{route('product.index')}}" class="bg-red-600 text-white px-10 py-3 rounded-lg">Exit</a>
    </div>
</form>

@endsection
