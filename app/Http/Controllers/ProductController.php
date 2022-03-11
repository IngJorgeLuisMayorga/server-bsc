<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getAll(Request $request) {
        $products = Product::with(['category_skin_id', 'category_main_ingredient_id', 'category_solution_id', 'category_step_id', 'category_extra_id'])->get();
        return json_encode($products);
    }
    public function getRecommended(Request $request) {
        $id = $request->id;
        $product = Product::where('id' , '=' , $id)->first();
        $categoryStepId= Categories::where('id' , '=' , $product->category_step_id)->first();
        $products = Product::where('category_step_id', '!=', $categoryStepId)
        ->with(['category_skin_id', 'category_main_ingredient_id', 'category_solution_id', 'category_step_id', 'category_extra_id'])
        ->get()        
        ->random(3);
        return json_encode($products);
    }
    public function getById(Request $request, $id) {

        $product = Product::where('id' , '=' , $id)->first();
        $categorySkinId = $product->category_skin_id;
        $categoryMainIngredientId = $product->category_main_ingredient_id;
        $categorySolutionId = $product->category_solution_id;
        $categoryStepId = $product->category_step_id;
        $categoryExtraId = $product->category_extra_id;

        $categorySkin = Categories::where('id' , '=' , $categorySkinId)->first();
        $categoryMainIngredient= Categories::where('id' , '=' , $categoryMainIngredientId)->first();
        $categorySolution= Categories::where('id' , '=' , $categorySolutionId)->first();
        $categoryStepId= Categories::where('id' , '=' , $categoryStepId)->first();
        $categoryExtraId= Categories::where('id' , '=' , $categoryExtraId)->first();
        
        $product->category_skin = $categorySkin;
        $product->category_main_ingredient = $categoryMainIngredient;
        $product->category_solution = $categorySolution;
        $product->category_step = $categoryStepId;
        $product->category_extra = $categoryExtraId;

        return json_encode($product);
    }
    public function getByIds(Request $request, $ids) {
        $products = Product::whereIn('id', explode(',', $ids))->get();
        return json_encode($products);
    }
    public function add(Request $request) {
        $product = new Product;
        $data = $request->only($product->getFillable());
        $product->fill($data);
        $product->save();
        return json_encode($product);
    }
    public function update(Request $request, $id) {
        $product = Product::where('id' , '=' , $id)->first();
        $data = $request->only($product->getFillable());
        $product->fill($data);
        $product->save();
        return json_encode($product);
    }
    public function uploadPicture(Request $request) {

        if($request->hasFile('image1')){
            $this->validate($request, [
                'image1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        }
        if($request->hasFile('image2')){
            $this->validate($request, [
                'image2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        }
        if($request->hasFile('image3')){
            $this->validate($request, [
                'image3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        }
        if($request->hasFile('image4')){
            $this->validate($request, [
                'image4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        }

        $out = [
            'image1' => '',
            'image2' => '',
            'image3' => '',
            'image4' => '',
        ];

        if ($request->hasFile('image1')) {
            $image = $request->file('image1');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $out['image1'] = $name;
        } 
        
        if ($request->hasFile('image2'))  {
            $image = $request->file('image2');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $out['image2'] = $name;
        } 
        
        if ($request->hasFile('image3'))  {
            $image = $request->file('image3');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $out['image3'] = $name;
        }
        
        if ($request->hasFile('image4'))  {
            $image = $request->file('image4');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $out['image4'] = $name;
        }

        return json_encode($out);
        
    }
    public function remove(Request $request, $id) {
        $product = Product::where('id' , '=' , $id)->first();
        $product->delete();
        return json_encode($product);
    }
}
