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

    protected $restaurant;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
    }

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

        $name = "Restaurant";
        $city = "Nancy";

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

        $response->assertStatus(200);

        /*
         * Check if the restaurant has been inserted
         */

        $restaurant = Restaurant::latest('id')->first();
        $this->assertEquals($restaurant->name, $name, 'Restaurant should be inserted');
        $this->assertEquals($restaurant->coordinate->city, $city, 'Coordinate should be inserted');

        /*
         * Clean the restaurant
         */

        $restaurant->coordinate()->delete();
        $restaurant->delete();
    }

    /**
     * @test
     */
    public function show()
    {
        $response = $this->get("/api/restaurants/{$this->restaurant->id}");
        $json = $response->getContent();

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function update()
    {
        $name = "Restaurant";
        $city = "Nancy";

        $response = $this->put("/api/restaurants/{$this->restaurant->id}", [
            'name' => $name,
            'full_address' => $this->faker->address(),
            'city' => $city,
            'postal_code' => $this->faker->postcode(),
            'lat_address' => $this->faker->latitude(),
            'lng_address' => $this->faker->longitude(),
            'number_phone' => $this->faker->e164PhoneNumber(),
            'country' => $this->faker->country()
        ]);

        $response->assertStatus(200);

        /*
         * Check if the restaurant has been updated
         */

        $restaurant = Restaurant::find($this->restaurant->id);
        $this->assertEquals($restaurant->name, $name, 'Restaurant should be updated');
        $this->assertEquals($restaurant->coordinate->city, $city, 'Coordinate should be updated');
    }

    /**
     * @test
     */
    public function destroy() {

        $restaurantId = $this->restaurant->id;
        $coordinateId = $this->restaurant->coordinate->id;

        $response = $this->delete("/api/restaurants/{$this->restaurant->id}");

        $response->assertStatus(200);

        /*
         * Check if the restaurant has been deleted
         */

        $this->assertNull(Restaurant::find($restaurantId), 'The restaurant shouldn\'t be found');
        $this->assertNull(Coordinate::find($coordinateId), 'The coordinates should be destroyed');
    }

    public function tearDown(): void
    {
        $this->restaurant->coordinate()->delete();
        $this->restaurant->delete();
        parent::tearDown();
    }
}
