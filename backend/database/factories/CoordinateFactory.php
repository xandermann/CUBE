<?php

namespace Database\Factories;

use App\Models\Coordinate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoordinateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coordinate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'lat_address' => $this->faker->latitude(),
            'lng_address' => $this->faker->longitude(),
            'number_phone' => $this->faker->e164PhoneNumber(),
            'country' => $this->faker->country()
        ];
    }
}
