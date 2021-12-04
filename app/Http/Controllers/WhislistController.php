<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Whislist;
use Illuminate\Http\Request;

class WhislistController extends Controller
{
    public function getAll(Request $request) {
        $whislists = Whislist::all();
        return json_encode($whislists);
    }
    public function getById(Request $request, $id) {
        $whislist = Whislist::where('id' , '=' , $id)->first();
        return json_encode($whislist);
    }
    public function getByUserId(Request $request, $id) {
        $whislist = Whislist::where('user_id' , '=' , $id)->with('product')->get();
        return json_encode($whislist);
    }
    public function getByIds(Request $request, $ids) {
        $whislists = Whislist::whereIn('id', explode(',', $ids))->get();
        return json_encode($whislists);
    }
    public function add(Request $request) {
        $whislist = new Whislist;
        $data = $request->only($whislist->getFillable());
        $whislist->fill($data);
        $whislist->save();
        return json_encode($whislist);
    }
    public function update(Request $request, $id) {
        $whislist = Whislist::where('id' , '=' , $id)->first();
        $data = $request->only($whislist->getFillable());
        $whislist->fill($data);
        $whislist->save();
        return json_encode($whislist);
    }
    public function remove(Request $request, $id) {
        $whislist = Whislist::where('id' , '=' , $id)->first();
        $whislist->delete();
        return json_encode($whislist);
    }
}
