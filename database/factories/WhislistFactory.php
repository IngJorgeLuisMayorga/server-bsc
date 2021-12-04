<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use App\Models\Whislist;
use Illuminate\Database\Eloquent\Factories\Factory;

class WhislistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Whislist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'product_id' => $this->faker->numberBetween(1, Product::count()),
            'add_at' => now(),
            'updated_at' => now(),
            'created_at' => now(),
        ];
    }
}
