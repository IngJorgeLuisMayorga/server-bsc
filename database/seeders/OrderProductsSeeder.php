<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $orders = Order::all();

        error_log(' ');
        error_log(' [SEEDING] [ORDER PRODUCTS] -> START ');
        error_log(' ');

        foreach ($orders as $order) {

            // Create Order Product Relationship
            $order_id = $order->id;
            $products = json_decode($order->order_products_json);
            error_log('  $order_id  => '.$order_id);
            error_log('  $products size  => '.count($products));

            foreach ($products as $product) {
                DB::table('order_products')->insert([
                    'order_id' => $order_id,
                    'product_id' => $product->id,
                    'updated_at' =>  date("Y-m-d H:i:s"),
                    'created_at' =>  date("Y-m-d H:i:s"),
                ]);
            }

        }

    }
}
