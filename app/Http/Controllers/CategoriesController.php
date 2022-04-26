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


    public function uploadPicture(Request $request) {

        if($request->hasFile('picture_normal')){
            $this->validate($request, [
                'picture_normal' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        }
        if($request->hasFile('picture_hover')){
            $this->validate($request, [
                'picture_hover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        }

        $out = [
            'picture_normal' => '',
            'picture_hover' => '',
        ];

        if ($request->hasFile('picture_normal')) {
            $image = $request->file('picture_normal');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $out['picture_normal'] = $name;
        } 
        
        if ($request->hasFile('picture_hover'))  {
            $image = $request->file('picture_hover');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $out['picture_hover'] = $name;
        } 
        

        return json_encode($out);
        
    }
}
