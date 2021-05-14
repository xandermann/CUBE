<?php

namespace Tests\Feature;

use App\Models\Coordinate;
use App\Models\Restaurant;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RestaurantApiTest extends TestCase
{

    use WithFaker;

    /**
     * @test
     */
    public function index()
    {
        $response = $this->get('/api/restaurants');

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store() {

        $name = $this->faker->company() . uniqid();
        $city = $this->faker->city() . uniqid();

        $response = $this->post('/api/restaurants', [
            'name' => $name,

            'full_address' => $this->faker->address(),
            'city' => $city,
            'postal_code' => $this->faker->postcode(),
            'lat_address' => $this->faker->latitude(),
            'lng_address' => $this->faker->longitude(),
            'number_phone' => $this->faker->e164PhoneNumber(),
            'country' => $this->faker->country(),
        ]);

        $restaurant = Restaurant::latest()->first();

        $this->assertEquals($restaurant->name, $name, 'Restaurant should be inserted');
        $this->assertEquals($restaurant->coordinate->city, $city, 'Coordinate should be inserted');

        $response->assertStatus(200);

        $restaurant->delete(); // clean
    }

    /**
     * @test
     */
    public function show()
    {
        $response = $this->get('/api/restaurants/1');

        $json = $response->getContent();

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function update()
    {
        $id = Restaurant::latest()->first()->id;
        $name = $this->faker->company() . uniqid();
        $city = $this->faker->city() . uniqid();

        $response = $this->put("/api/restaurants/$id", [
            'name' => $name,

            'full_address' => $this->faker->address(),
            'city' => $city,
            'postal_code' => $this->faker->postcode(),
            'lat_address' => $this->faker->latitude(),
            'lng_address' => $this->faker->longitude(),
            'number_phone' => $this->faker->e164PhoneNumber(),
            'country' => $this->faker->country(),
        ]);

        $restaurant = Restaurant::latest()->first();

        $this->assertEquals($restaurant->name, $name, 'Restaurant should be updated');
        $this->assertEquals($restaurant->coordinate->city, $city, 'Coordinate should be updated');

        $response->assertStatus(200);

    }

    /**
     * @test
     */
    public function destroy() {

        $restaurant = Restaurant::factory()->create();

        $response = $this->delete("/api/restaurants/{$restaurant->id}");

        $response->assertStatus(200);

        $this->assertNull(Restaurant::find($restaurant->id), 'The restaurant shouldn\'t be found');
        $this->assertNull(Coordinate::find($restaurant->coordinate->id), 'The coordinates should be destroyed');

    }
}
