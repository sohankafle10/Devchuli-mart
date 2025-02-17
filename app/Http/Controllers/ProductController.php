<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Categories::orderBy('priority')->get();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|numeric',
            'status' => 'required',
            'photopath' => 'required|image',

        ]);


        //store picture
        $photo = $request->file('photopath');
        $photoname = time() . '.' . $photo->extension();
        $photo->move(public_path('images/products'), $photoname);
        $data['photopath'] = $photoname;

        Product::create($data);
        return redirect(route('product.index'))->with('success', 'product created successfully');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Categories::orderBy('Priority')->get();
        return view('product.edit', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|numeric',
            'status' => 'required',
            'photopath' => 'nullable|image',

        ]);
        $product = Product::find($id);
        $data['photopath'] = $product->photopath;
        if ($request->hasFile('photopath')) {
            //store picture
            $photo = $request->file('photopath');
            $photoname = time() . '.' . $photo->extension();
            $photo->move(public_path('images/products'), $photoname);
            $data['photopath'] = $photoname;

            //delete old photo
            $oldphoto = public_path('image/products/' . $product->photopath);
            if (file_exists($oldphoto)) {
                unlink($oldphoto);
            }
        }
        $product->update($data);
        return redirect(route('product.index'))->with('success', 'product Updated successfully');
    }

    public function destroy($id) {

      
            $product = Product::findOrFail($id);
        
            // Check if the product is in any pending or processing orders
            $hasPendingOrders = Order::where('product_id', $id)
                                    ->whereIn('status', ['pending', 'processing'])
                                    ->exists();
        
            if ($hasPendingOrders) {
                return redirect()->route('product.index')->with('success', 'Cannot delete product. It is associated with a pending or processing order.');
            }
        
            // Get the product image path
            $photoPath = public_path('images/products/' . $product->photopath);
        
            // Delete the image if it exists
            if (file_exists($photoPath) && is_file($photoPath)) {
                unlink($photoPath);
            }
        
            // Delete the product
            $product->delete();
        
            return redirect()->route('product.index')->with('success', 'Product Deleted Successfully')->with('success', 'Product delete Successfully');
        }
        
}
