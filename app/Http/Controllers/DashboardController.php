<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $categories=Categories::count();

        //if any specific matra condition lagayeyra nikalna
        // $products= Product::where('status','show')->count();


        $products= Product::count();
        $processing_order = Product::where('status','Processing')->count();
        $pending_order = Order::where('status','Pending')->count();
        $completed_order = Order::where('status','Delivered')->count();
        $users = User::where('role', 'user')->count();
        return view('dashboard',compact('categories','products', 'processing_order', 'pending_order', 'completed_order', 'users'));
    }
   
}
