<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Categories::orderBy('priority')->get();
        return view('category.index',compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {

    //  dd($request->all());
      $data=$request->validate([
        'priority' => 'required | numeric',
        'name'=> 'required',
    ]);


    Categories::create($data);
    // return redirect()->route('category.index');
    return redirect()->route('category.index')
    -> with('success','Category Created Sucessfully');
    }

    public function edit($id){
        $category=Categories::find($id);
        return view('category.edit',compact('category'));
    }

    public function update(Request $request,$id){

        $data=$request->validate([
            'priority' => 'required | numeric',
            'name'=> 'required',
        ]);

        $category=Categories::find($id);
        $category->update($data);
        return redirect()->route('category.index')
    -> with('success','Category Updated Sucessfully');

    }

    public function destroy(Request $request){

        $category=Categories::find($request->dataid);
        $products=Product::where('category_id',$request->dataid)->count();
        if($products>0){
            return redirect()->route('category.index')->with('success','Category cannot be Deleted, It has product');
        }
        $category->delete();
        return redirect()->route('category.index')
    -> with('success','Category Deleted Sucessfully');



    }

}
