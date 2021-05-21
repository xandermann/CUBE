<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Coordinate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
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
        $email = $this->faker->email;

        return [
            'email' => $email,
            'password' => $email, // The password is the same than email
            'firstname' => substr($email, 0, 10),
            'lastname' => substr($email, 0, 10),
            'is_admin' => '1',
            'coordinate_id' => Coordinate::factory()
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
