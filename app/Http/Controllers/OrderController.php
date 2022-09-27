<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
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

        $products = json_decode($request->order_products_json, true);
        foreach($products as $product) {
            $product_id = $product['id'];
            $order_id = $order->id;
            DB::table('order_products')->insert([
                'order_id' => $order_id,
                'product_id' => $product_id,
                'updated_at' =>  date("Y-m-d H:i:s"),
                'created_at' =>  date("Y-m-d H:i:s"),
            ]);
        }

        return json_encode($order);
    }
    public function update(Request $request, $id) {

        $order = Order::where('id' , '=' , $id)->first();
        $data = $request->only($order->getFillable());
        $order->fill($data);

        // S1_ORDERED (ACCEPTED PAYMENT)
        if($request->shipping_status === 's1_ordered'){
            //Add Payment
            $payment = new Payment;
            $payment->fill([
                'method' => $request->paymentMethodType,
                'reference' => $order->order_ref,
                'amount' => $order->order_total,
                'wompi_amount_in_cents' => $request->amountInCents,
                'wompi_currency'  => $request->currency,
                'wompi_method'  => $request->paymentMethodType,
                'wompi_id'  => $request->id,
                'user_id' => $order->user_id,
            ]);
            $payment->save();

            //Update Shipping Status
            $order->fill([
                'payment_approved_at'=> Carbon::now(),
                'payment_id'=> $payment->id,
                'payment_method'=> $payment->method,
                'payment_wompi_id'=> $payment->wompi_id,
                'shipping_status' => $request->shipping_status,
                'shipping_ordered_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ])->update();
            $order->save();
        } 

        // S2_SHIPPED (SHIPPED TO USER)
        if($request->shipping_status === 's2_shipped'){
            //Update Shipping Status
            $order->fill([
                'shipping_guide_ref' => $request->shipping_guide_ref,
                'shipping_guide_company' => $request->shipping_guide_company, 
                'shipping_status' => $request->shipping_status,
                'shipping_shipped_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ])->update();
            $order->save();
        }
        
        // S3_DELIVERED (IN USER HANDS)
        if($request->shipping_status === 's3_delivered'){
            //Update Shipping Status
            $order->fill([
                'shipping_status' => $request->shipping_status,
                'shipping_delivered_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ])->update();
            $order->save();
        } 

        // Get User,Products, Payment and Cupon
        $order = Order::where('id' , '=' , $id)->first();
        $user = User::where('id' , '=' , $order->user_id)->first();  
        $coupon = Cupon::where('id' , '=' , $order->coupon_id)->first();
        $productsIds = DB::table('order_products')->where('order_id', '=', $order->id)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productsIds)->get();
 
        //Send Email 
        $email = $order->user_email;
        Mail::to($email)->send(new OrderEmail($order, $user, $products, $order->shipping_status ));

        return json_encode($order);
    }
    public function remove(Request $request, $id) {
        $order = Order::where('id' , '=' , $id)->first();
        $order->delete();
        return json_encode($order);
    }
    public function pdf($id){

        $order = Order::where('id' , '=' , $id)->first();
        $order->user_id = 11;
        $order->save();

        $user = User::where('id' , '=' , $order->user_id)->first();
        $payment = Payment::where('id' , '=' , $order->payment_id)->first();
        $coupon = Cupon::where('id' , '=' , $order->coupon_id)->first();

        $productsIds = DB::table('order_products')->where('order_id', '=', $order->id)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productsIds)->get();

        Carbon::setLocale('es');
        $fecha = Carbon::parse($order->updated_at);
        $fecha->diffForHumans(); //esto se mostrará en español
        $fecha->format("F"); // Inglés.

        // Change the line below to your timezone!
        date_default_timezone_set('America/Lima');
        $date = date('m_d_Y_h_i_s', time());

        view()->share('order', $order);
        view()->share('user', $user);
        view()->share('payment', $payment);
        view()->share('coupon', $coupon);
        view()->share('products', $products);
        view()->share('fecha', $fecha);

        $pdf = PDF::loadView('PDFs.order_pdf', [
            'order' => $order, 
            'user' => $user,
            'payment' => $payment,
            'coupon' => $coupon,
            'products' => $products,
            'fecha' => $fecha,
        ]);
        return $pdf->download('BSC_Order_'.$date.'.pdf');
    }
    public function preview_pdf($id){

        $order = Order::where('id' , '=' , $id)->first();
        $order->user_id = 11;
        $order->save();

        $user = User::where('id' , '=' , $order->user_id)->first();
        $payment = Payment::where('id' , '=' , $order->payment_id)->first();
        $coupon = Cupon::where('id' , '=' , $order->coupon_id)->first();

        $productsIds = DB::table('order_products')->where('order_id', '=', $order->id)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productsIds)->get();

        Carbon::setLocale('es');
        $fecha = Carbon::parse($order->updated_at);
        $fecha->diffForHumans(); //esto se mostrará en español
        $fecha->format("F"); // Inglés.
    
        return view('PDFs.order_pdf', [
            'order' => $order, 
            'user' => $user,
            'payment' => $payment,
            'coupon' => $coupon,
            'products' => $products,
            'fecha' => $fecha
        ]);

    } 
    public function preview_email_order($id, $status){

        $order = Order::where('id' , '=' , $id)->first();
        $user = User::where('id' , '=' , $order->user_id)->first();  
        $payment = Payment::where('id' , '=' , $order->payment_id)->first();
        $coupon = Cupon::where('id' , '=' , $order->coupon_id)->first();
        $productsIds = DB::table('order_products')->where('order_id', '=', $order->id)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productsIds)->get();
      
        return view('emails.order-email', [
            'order' => $order, 
            'user' => $user,
            'payment' => $payment,
            'coupon' => $coupon,
            'products' => $products,
            'status' => $status
        ]);
        
        //return json_encode($order->user_id);
    }
    public function send_email_order($id, $status){
        $order = Order::where('id' , '=' , $id)->first();
        $order->user_id = 11;
        $order->save();

        $user = User::where('id' , '=' , $order->user_id)->first();  
        $coupon = Cupon::where('id' , '=' , $order->coupon_id)->first();
        $productsIds = DB::table('order_products')->where('order_id', '=', $order->id)->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $productsIds)->get();
        //$email = $order->user_email;
        $email = 'jl.mayorga236@gmail.com';
        Mail::to($email)->send(new OrderEmail($order, $user, $products,  $status ));
        return json_encode($products);
    }
}
