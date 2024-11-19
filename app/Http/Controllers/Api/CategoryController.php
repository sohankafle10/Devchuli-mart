<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Categories::orderBy('priority')->get();
        return response()->json([
            'msg'=>'Category Fetched Successfully',
            'data'=>$categories
        ]);
    }
}
