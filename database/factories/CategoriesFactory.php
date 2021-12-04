<?php

namespace Database\Factories;


use Carbon\Carbon;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categories::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = Carbon::create(2015, 5, 28, 0, 0, 0);
        $type = $this->faker->randomElement(['SKIN', 'MAIN_INGREDIENT', 'SOLUTION', 'STEP', 'EXTRA']);
        $name = $this->faker->name();
        return [
            'name' => $name,
            'type' => $type,
            'picture_normal' => 'http://lorempixel.com/400/200/people/?seed='.$this->faker->numberBetween(0,2025),
            'picture_hover' => 'http://lorempixel.com/400/200/people/?seed='.$this->faker->numberBetween(0,2025)
        ];
    }
}
