<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Cupon;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use App\Mail\OrderEmail;

class OrderController extends Controller
{
    public function getAll(Request $request) {
        $orders = Order::all();
        return json_encode($orders);
    }
    public function getById(Request $request, $id) {
        $order = Order::where('id' , '=' , $id)->first();
        return json_encode($order);
    }
    public function getByUserId(Request $request, $id) {
        $orders = Order::where('user_id' , '=' , $id)->get();
        return json_encode($orders);
    }
    public function getByIds(Request $request, $ids) {
        $orders = Order::whereIn('id', explode(',', $ids))->get();
        return json_encode($orders);
    }
    public function add(Request $request) {
        $order = new Order;
        $data = $request->only($order->getFillable());
        $order->fill($data);
        $order->save();

        //$user = User::where('id' , '=' , $order->user_id)->first();
        //$payment = Payment::where('id' , '=' , $order->payment_id)->first();
        //$cupon = Cupon::where('id' , '=' , $order->coupon_id)->first();

        // SEND EMAIL
        $email = 'wallamejorge@hotmail.com';
        Mail::to($email)->send(new OrderOrdered($order));

        return json_encode($order);
    }
    public function update(Request $request, $id) {

        $status = $request->status;

        $order = Order::where('id' , '=' , $id)->first();
        $data = $request->only($order->getFillable());
        $order->fill($data);
        $order->save();

        $user = User::where('id' , '=' , $order->user_id)->first();  
        $payment = Payment::where('id' , '=' , $order->payment_id)->first();
        $coupon = Cupon::where('id' , '=' , $order->coupon_id)->first();
        $products = Product::hydrate((array)json_decode($order->products_json, true));
        $collection = json_decode($order->products_json, true);

        //$email = 'wallamejorge@hotmail.com';
        //$email = 'malejandramayorga@gmail.com'; //$user->email;
        $email = 'jl.mayorga236@gmail.com'; //$user->email;

        Mail::to($email)->send(new OrderEmail($order, $user, $payment, $products, $status ));
        return json_encode($order);

        return json_encode($order);
    }
    public function remove(Request $request, $id) {
        $order = Order::where('id' , '=' , $id)->first();
        $order->delete();
        return json_encode($order);
    }
    public function pdf($id){

        $order = Order::where('id' , '=' , $id)->first();
        $user = User::where('id' , '=' , $order->user_id)->first();
        $payment = Payment::where('id' , '=' , $order->payment_id)->first();
        $coupon = Cupon::where('id' , '=' , $order->coupon_id)->first();

        $products = Product::hydrate((array)$order->products_json);
        $collection = json_decode($order->products_json, true);

        // Change the line below to your timezone!
        date_default_timezone_set('America/Lima');
        $date = date('m_d_Y_h_i_s', time());

        $order = Order::where('id' , '=' , $id)->first();
        view()->share('invoice', $order);
        view()->share('user', $user);
        view()->share('payment', $payment);
        view()->share('coupon', $coupon);
        view()->share('products', $collection);

        $pdf = PDF::loadView('PDFs.order_pdf', [
            'invoice' => $order, 
            'user' => $user,
            'payment' => $payment,
            'coupon' => $coupon,
            'products' => $collection
        ]);
        return $pdf->download('BSC_Order_'.$date.'.pdf');
    }
    public function preview_pdf($id){

        $order = Order::where('id' , '=' , $id)->first();
        $user = User::where('id' , '=' , $order->user_id)->first();
        $payment = Payment::where('id' , '=' , $order->payment_id)->first();
        $coupon = Cupon::where('id' , '=' , $order->coupon_id)->first();

        $products = Product::hydrate((array)$order->products_json);
        $collection = json_decode($order->products_json, true);
        //$products = $products->flatten();

        return view('PDFs.order_pdf', [
            'invoice' => $order, 
            'user' => $user,
            'payment' => $payment,
            'coupon' => $coupon,
            'products' => $collection
        ]);

    } 
    public function preview_email_order($id, $status){

        $order = Order::where('id' , '=' , $id)->first();
        $user = User::where('id' , '=' , $order->user_id)->first();  
        $payment = Payment::where('id' , '=' , $order->payment_id)->first();
        $coupon = Cupon::where('id' , '=' , $order->coupon_id)->first();
        $products = Product::hydrate((array)json_decode($order->products_json, true));
        $collection = json_decode($order->products_json, true);

        return view('emails.order-email', [
            'invoice' => $order, 
            'user' => $user,
            'payment' => $payment,
            'coupon' => $coupon,
            'products' => $products,
            'status' => $status
        ]);
    }
    public function send_email_order($id, $status){

        $order = Order::where('id' , '=' , $id)->first();
        $user = User::where('id' , '=' , $order->user_id)->first();  
        $payment = Payment::where('id' , '=' , $order->payment_id)->first();
        $coupon = Cupon::where('id' , '=' , $order->coupon_id)->first();
        $products = Product::hydrate((array)json_decode($order->products_json, true));
        $collection = json_decode($order->products_json, true);

        $email = 'wallamejorge@hotmail.com';
        //$email = 'malejandramayorga@gmail.com'; //$user->email;
        //$email = 'jl.mayorga.co@gmail.com'; //$user->email;

        Mail::to($email)->send(new OrderEmail($order, $user, $payment, $products, $status ));
        return json_encode($order);
    }
}
