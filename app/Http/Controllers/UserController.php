
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // Get the total number of users
        $totalUsers = User::count();

        // Get all users data
        $users = User::all();

        // Return the view with users data
        return view('users.index', compact('totalUsers', 'users'));
    }

    /**
     * Show a specific user details.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the user.
     */
    public function edit($id)
   
}