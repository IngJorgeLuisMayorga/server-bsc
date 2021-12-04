<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = Carbon::create(2015, 5, 28, 0, 0, 0);
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'nid_type' => $this->faker->randomElement(['CC', 'CI', 'CE', 'TI']),
            'nid_number' => $this->faker->numberBetween(1010201000,2020200000),
            'birthdate' => $this->faker->dateTimeBetween($startDate = '-40 years', $endDate = '-14 years'),
            'points' => 0,
            'photo' => 'http://lorempixel.com/400/200/people/?seed='.$this->faker->numberBetween(0,2025) ,
            'phone' => $this->faker->phoneNumber(),
            'city' =>  $this->faker->city(),
            'address' => $this->faker->address(),
            'comments' => $this->faker->realText(50)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
