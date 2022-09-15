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

        $reference = hexdec(md5('PAYMENT'.$this->faker->numberBetween(100000, 1000000).$products->toJson().date("Y-m-d H:i:s")));

        // Calculate payments and ta
        foreach ($products as $product) {
            $price_product = ($product->price)*(1 - (0.01*$product->discount));
            $total = $total  + $price_product;
            $discounts  = $discounts + ($product->price)*((0.01*$product->discount));
            $taxes =  $taxes + ($price_product)*(((0.01*$product->discount))/(1 + (0.01*$product->discount)));
            $points = round($total/1000);
            $subtotal = $total - $taxes ;
        }

 
        // Update Points
        $user->points = $user->points + $points;
        $user->save();

        // Create Payment
        DB::table('payments')->insert([
            'method' => 'CREDIT_CARD_PAYU',
            'reference' => $reference,
            'amount' => $total,
            'user_id' => $user_id,
            'updated_at' =>  date("Y-m-d H:i:s"),
            'created_at' =>  date("Y-m-d H:i:s"),
        ]);
        $payment = Payment::where('reference', $reference)->first();
        error_log('  $subtotal  => '.$subtotal);

        return [
            'user_id' => $user_id ,
            'user_nid_type' => $user->nid_type  ,
            'user_nid_number' => $user->nid_number ,
            'user_email' => $user->email,
            'user_name' => $user->name ,
            'user_first_name' => $user->first_name ,
            'user_last_name' => $user->last_name ,

            'payment_id'  => $payment->id,
            'payment_method' => 'WOMPI_SEED',
            'payment_approved_at' => date("Y-m-d H:i:s"),
            'payment_wompi_id' => '1112568-1660934151-61495',

            'coupon_id' => NULL,
            'coupon_discount' => 0.0,
            
            'order_ref' => $reference,
            'order_points' => $user->points,
            'order_subtotal' => 0,
            'order_taxes' => 0,
            'order_total' => 0,
            'order_products_json' => $products->toJson(),
    
            //Shipping Info
            'shipping_status' => 's0_pending',
            'shipping_guide_ref' => '#334323-2323',
            'shipping_guide_company' => 'DEPRISA',
            'shipping_ordered_at' => NULL,
            'shipping_shipped_at' => NULL,
            'shipping_delivered_at' => NULL,
            'shipping_country' => $this->faker->country() ,
            'shipping_department' => $this->faker->state(),
            'shipping_city' => $this->faker->city() ,
            'shipping_phone' =>  $this->faker->phoneNumber(),
            'shipping_address' =>  $this->faker->address(),

            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}
