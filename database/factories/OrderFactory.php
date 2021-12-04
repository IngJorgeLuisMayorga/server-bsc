<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        error_log(' ORDER FACTORY NEW ORDER');
        $user_id = $this->faker->numberBetween(1, User::count());
        $user = User::where('id', $user_id)->first();

        $n = $this->faker->numberBetween(1,8);
        $products = Product::inRandomOrder()->limit($n)->get();
        $productsIds = $products->pluck('id');

        error_log('  $user_id  => '.$user_id);
        error_log('  $n  => '.$n);

        $total = 0;
        $discounts = 0;
        $subtotal = 0;
        $taxes = 0;
        $points = 0;

        // Calculate payments and ta
        foreach ($products as $product) {
            $price_product = ($product->price)*(1 - (0.01*$product->discount));
            $total = $total  + $price_product;
            $discounts  = $discounts + ($product->price)*((0.01*$product->discount));
            $taxes =  $taxes + ($price_product)*(((0.01*$product->discount))/(1 + (0.01*$product->discount)));
            $points = round($total/1000);
            $subtotal = $total - $taxes ;
        }

        $user->points = $user->points + $points;
        $user->save();

        // Create Payment
        $payment_reference = hexdec(md5('PAYMENT'.$this->faker->numberBetween(100000, 1000000).$products->toJson().date("Y-m-d H:i:s")));
        DB::table('payments')->insert([
            'method' => 'CREDIT_CARD_PAYU',
            'reference' => $payment_reference,
            'amount' => $total,
            'user_id' => $user_id,
            'updated_at' =>  date("Y-m-d H:i:s"),
            'created_at' =>  date("Y-m-d H:i:s"),
        ]);
        $payment = Payment::where('reference', $payment_reference)->first();

        return [

             'user_id' => $user_id ,
             'payment_id' => $payment->id,
             'coupon_id' => NULL,

             'phone' =>  $this->faker->phoneNumber(),
             'address' =>  $this->faker->address(),
             'city' =>  $this->faker->city(),

             'subtotal' => $subtotal,
             'taxes' => $taxes ,
             'discounts' => $discounts,
             'points' => $points,
             'total' => $total ,

             'ordered_at' => now(),
             'shipped_at' => NULL,
             'delivered_at' => NULL,

             'products_json' => $products->toJson(),
             'coupon_json' => '{}',

            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}
