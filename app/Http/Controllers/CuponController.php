<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
  
    public function getAll(Request $request) {
        $cupons = Cupon::all();
        return json_encode($cupons);
    }
    public function getById(Request $request, $id) {
        $cupon = Cupon::where('id' , '=' , $id)->first();
        return json_encode($cupon);
    }
    public function getByUserId(Request $request, $id) {
        $cupons = Cupon::where('user_id' , '=' , $id)->get();
        return json_encode($cupons);
    }
    public function getByIds(Request $request, $ids) {
        $cupons = Cupon::whereIn('id', explode(',', $ids))->get();
        return json_encode($cupons);
    }
    public function add(Request $request) {
        $cupon = new Cupon;
        $data = $request->only($cupon->getFillable());
        $cupon->fill($data);
        $cupon->save();
        return json_encode($cupon);
    }
    public function update(Request $request, $id) {
        error_log(' public function update(Request $request, $id) ');
        error_log($request);
        $cupon = Cupon::where('id' , '=' , $id)->first();
        $data = $request->only($cupon->getFillable());
        $cupon->fill($data);
        $cupon->save();
        return json_encode($cupon);
    }
    public function remove(Request $request, $id) {
        $cupon = Cupon::where('id' , '=' , $id)->first();
        $cupon->delete();
    }
}