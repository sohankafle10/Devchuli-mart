<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Count total categories
        $categories = Categories::count();

        // Count total products
        $products = Product::count();

        // Count orders with 'Processing' status
        $processing_order = Order::where('status', 'Processing')->count();

        // Count orders with 'Pending' status
        $pending_order = Order::where('status', 'Pending')->count();

        // Count orders with 'Delivered' status (Completed orders)
        $completed_order = Order::where('status', 'Delivered')->count();

        // Count users with role 'user'
        $users = User::where('role', 'user')->count();

        // Return data to the dashboard view
        return view('dashboard', compact('categories', 'products', 'processing_order', 'pending_order', 'completed_order', 'users'));
    }

    // Method to view all users
    public function user()
    {
        $users = User::all();
        return view('viewuser', compact('users'));
    }
}
