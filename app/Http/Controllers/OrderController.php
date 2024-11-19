<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
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
            //store order here
            $cart = Cart::find($cartid);
            $data = [
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'price' => $cart->product->price,
                'payment_method' => 'Esewa',
                'name' => $cart->user->name,
                'phone' => '9802973937',
                'address' => 'Gaindakot',
            ];

            Order::create($data);
            $cart->delete();
            return redirect(route('home'))->with('success', 'Order placed successfully');
        }
    }

    public function storecod(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $data = [
            'user_id' => $cart->user_id,
            'product_id' => $cart->product_id,
            'qty' => $cart->qty,
            'price' => $cart->product->price,
            'payment_method' => 'COD',
            'name' => $cart->user->name,
            'phone' => '9802973937',
            'address' => 'Gaindakot',
        ];


        Order::create($data);
        $cart->delete();
        return redirect(route('home'))->with('success', 'Order placed successfully');
    }

    public function status($id,$status){
        $order=Order::find($id);
        $order->status=$status;
        $order->save();
        //send mail to user
        $data=[
            'name'=>$order->name,
            'status'=>$status,
        ];
        Mail::send ('mail.order',$data,function($message)use($order){
            $message->to($order->user->email,$order->name)
            ->subject('Order Status');
        });

        return back()->with('success','Order is now '.$status);
    }
    public function myorder()
    {
        // Fetch orders for the logged-in user
        $orders = Order::where('user_id', Auth::id())->latest()->get();

        // Pass the orders to the Blade view
        return view('myorder', compact('orders'));
    }
}
