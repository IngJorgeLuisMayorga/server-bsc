<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return json_encode($order);
    }
    public function update(Request $request, $id) {
        $order = Order::where('id' , '=' , $id)->first();
        $data = $request->only($order->getFillable());
        $order->fill($data);
        $order->save();
        return json_encode($order);
    }
    public function remove(Request $request, $id) {
        $order = Order::where('id' , '=' , $id)->first();
        $order->delete();
        return json_encode($order);
    }
}
