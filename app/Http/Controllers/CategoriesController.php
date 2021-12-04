<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
 
    public function getAll(Request $request) {
        $categories = Categories::all();
        return json_encode($categories);
    }
    public function getById(Request $request, $id) {
        $category = Categories::where('id' , '=' , $id)->first();
        return json_encode($category);
    }
    public function getByIds(Request $request, $ids) {
        $categories = Categories::whereIn('id', explode(',', $ids))->get();
        return json_encode($categories);
    }
    public function add(Request $request) {
        $category = new Categories;
        $data = $request->only($category->getFillable());
        $category->fill($data);
        $category->save();
        return json_encode($category);
    }
    public function update(Request $request, $id) {
        $category = Categories::where('id' , '=' , $id)->first();
        $data = $request->only($category->getFillable());
        $category->fill($data);
        $category->save();
        return json_encode($category);
    }
    public function remove(Request $request, $id) {
        $category = Categories::where('id' , '=' , $id)->first();
        $category->delete();
        return json_encode($category);
    }
}
