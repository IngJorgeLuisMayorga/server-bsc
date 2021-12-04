<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . "/jsons/products.json";
        $products = json_decode(file_get_contents($path), true);

        error_log('[SEEDING] [PRODUCTS] -> DONE Start ');

        foreach ($products as $product) {

            $category_skin_id = Categories::where('type', 'SKIN')->orderByRaw('RAND()')->take(1)->get()->first()->id;
            $category_main_ingredient_id =  Categories::where('type', 'MAIN_INGREDIENT')->orderByRaw('RAND()')->take(1)->get()->first()->id;
            $category_solution_id = Categories::where('type', 'SOLUTION')->orderByRaw('RAND()')->take(1)->get()->first()->id;
            $category_step_id = Categories::where('type', 'STEP')->orderByRaw('RAND()')->take(1)->get()->first()->id;
            $category_extra_id = Categories::where('type', 'EXTRA')->orderByRaw('RAND()')->take(1)->get()->first()->id;

            $discount = rand(0,25);
            $quantity = rand(0,100);
            $sku = Hash::make('SKU'.rand(12560768,92560768).$product['name']);

            DB::table('products')->insert([

                'name' => $product['name'],
                'type' => 'SHOP',
                'description' => $product['description'],
                'ingredients' => 'N/A',
                'image1_src' => $product['image1_src'],
                'image2_src' => $product['image1_src'],
                'image3_src' => $product['image1_src'],
                'image4_src' => $product['image1_src'],
                'sku' => $sku,
                'price' => floatval($product['price'])*1000,
                'discount' => $discount,
                'quantity' => $quantity,

                'isDuo' => false,
                'productA_id' => NULL,
                'productB_id' => NULL,

                'category_skin_id' => $category_skin_id,
                'category_main_ingredient_id' =>  $category_main_ingredient_id ,
                'category_solution_id' => $category_solution_id,
                'category_step_id' => $category_step_id,
                'category_extra_id' => $category_extra_id,

                'updated_at' =>  date("Y-m-d H:i:s"),
                'created_at' =>  date("Y-m-d H:i:s"),
            ]);
       }

        //Product::factory()->count(50)->create();
        error_log('[SEEDING] [PRODUCTS] -> DONE ');
    }
}
