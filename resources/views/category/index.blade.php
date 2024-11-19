@extends('layouts.app')
@section('content')
    <h1 class="text-4xl font-extrabold text-blue-900">Categories</h1>
    <hr class="h-1 bg-red-500">

    <div class="text-right my-5">
        <a href="{{route('category.create')}}" class="bg-green-700  text-white px-5 py-3 rounded-lg">Add Category</a>
    </div>





    <table class="w-full mt-5">
        <tr>
            <th class="border p-2 bg-gray-200">Order</th>
            <th class="border p-2 bg-gray-200">Category Name</th>
            <th class="border p-2 bg-gray-200">Action</th>
        </tr>
        @foreach ($categories as $category )
        <tr class="text-center">
            <td class="border p-2">{{$category->priority}}</td>
            <td class="border p-2">{{$category->name}}</td>
            <td class="border p-2">
                <a href="{{route('category.edit',$category->id)}}" class="bg-blue-900 text-white px-3 py-1 rounded mx-1">Edit</a>
                <a  class="bg-red-600 text-white px-3 py-1 rounded mx-1 cursor-pointer"
                    onclick="showPopup('{{$category->id}}')">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>


{{-- techically called model/popup --}}

<div class="fixed bg-gray-600 inset-0 bg-opacity-50 backdrop-blur-sm hidden items-center justify-center" id="popup">
    <form action="{{route('category.destroy')}}"  method="POST" class="bg-white px-10 py-5 rounded-lg text-center">
        @csrf
        @method('DELETE')
        <h3 class="font-bold mb-5 text-lg">Are you sure to delete?</h3>
        <input type="hidden" id="dataid" name="dataid">
        <div class="flex gap-3">
            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded" >Yes! Delete</button>
            <a  class="bg-blue-600 text-white px-3 py-1 rounded cursor-pointer" onclick="hidePopup()">Cancel</a>

        </div>
    </form>
</div>
{{--End of popup Modal--}}


<script>
    function showPopup(a){
        document.getElementById('popup').classList.remove('hidden');
        document.getElementById('popup').classList.add('flex');
        document.getElementById('dataid').value = a;


    }

    function hidePopup(){
        document.getElementById('popup').classList.remove('flex');
        document.getElementById('popup').classList.add('hidden');

    }



</script>

@endsection

