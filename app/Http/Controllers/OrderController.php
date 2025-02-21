<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request, $cartid)
    {
        $data = $request->data;
        $data = base64_decode($data);
        $data = json_decode($data);

        if ($data->status == 'COMPLETE') {
            $cart = Cart::find($cartid);

            if (!$cart) {
                return back()->with('error', 'Cart item not found.');
            }

            $product = $cart->product;

            if (!$product || $product->stock < $cart->qty) {
                return back()->with('error', 'Not enough stock available.');
            }

            // Reduce stock
            $product->stock -= $cart->qty;
            $product->save();

            $orderData = [
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'price' => $cart->product->price,
                'payment_method' => 'Esewa',
                'name' => $cart->user->name,
                'phone' => $cart->user->phone,
                'address' => $cart->user->address,
            ];

            Order::create($orderData);
            $cart->delete();

            return redirect(route('home'))->with('success', 'Order placed successfully');
        }

        return back()->with('error', 'Payment was not completed.');
    }

    public function storecod(Request $request)
    {
        $cart = Cart::find($request->cart_id);

        if (!$cart) {
            return back()->with('error', 'Cart item not found.');
        }

        $product = $cart->product;

        if (!$product || $product->stock < $cart->qty) {
            return back()->with('error', 'Not enough stock available.');
        }

        // Reduce stock
        $product->stock -= $cart->qty;
        $product->save();

        $orderData = [
            'user_id' => $cart->user_id,
            'product_id' => $cart->product_id,
            'qty' => $cart->qty,
            'price' => $cart->product->price,
            'payment_method' => 'COD',
            'name' => $cart->user->name,
            'phone' => $cart->user->phone,
            'address' => $cart->user->address,
        ];

        Order::create($orderData);
        $cart->delete();

        return redirect(route('home'))->with('success', 'Order placed successfully');
    }

    public function status($id, $status)
    {
        $order = Order::find($id);

        if (!$order) {
            return back()->with('error', 'Order not found.');
        }

        $order->status = $status;
        $order->save();

        // Send email notification
        $data = [
            'name' => $order->name,
            'status' => $status,
        ];

        Mail::send('mail.order', $data, function ($message) use ($order) {
            $message->to($order->user->email, $order->name)
                ->subject('Order Status');
        });

        return back()->with('success', 'Order status updated to ' . $status);
    }

    public function myorder()
    {
        // Fetch orders for the logged-in user
        $orders = Order::where('user_id', Auth::id())->latest()->get();

        return view('myorder', compact('orders'));
    }
}
