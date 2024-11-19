<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $categories=Categories::count();

        //if any specific matra condition lagayeyra nikalna
        // $products= Product::where('status','show')->count();


        $products= Product::count();
        return view('dashboard',compact('categories','products'));
    }
    // sohan 
}
