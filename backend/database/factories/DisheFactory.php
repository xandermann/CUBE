<?php

namespace Database\Factories;

use App\Models\Dishe;
use Illuminate\Database\Eloquent\Factories\Factory;

class DisheFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dishe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100) 
        ];
    }
}
