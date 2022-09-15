<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getAll(Request $request) {
        $payments = Payment::all();
        return json_encode($payments);
    }
    public function getById(Request $request, $id) {
        $payments = Payment::where('id' , '=' , $id)->first();
        return json_encode($payments);
    }
    public function getByIds(Request $request, $ids) {
        $payments = Payment::whereIn('id', explode(',', $ids))->get();
        return json_encode($payments);
    }
    public function add(Request $request) {
        $payments = new Payment;
        $data = $request->only($payments->getFillable());
        $payments->fill($data);
        $payments->fill([
            'signin_at' =>  Carbon::parse($request->signin_at)
        ])->update();
        $payments->save();
        return json_encode($payments);
    }
    public function update(Request $request, $id) {
        $payments = Payment::where('id' , '=' , $id)->first();
        $data = $request->only($payments->getFillable());
        $payments->fill($data);
        $payments->save();
        return json_encode($payments);
    }
    public function remove(Request $request, $id) {
        $payments = Payment::where('id' , '=' , $id)->first();
        $payments->delete();
        return json_encode($payments);
    }

}
