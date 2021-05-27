<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\Ingredient;
use App\Models\Dishe;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DisheApiTest extends TestCase
{
    
    use WithFaker;

    protected $restaurant;
    protected $ingredient_1;
    protected $ingredient_2;
    protected $ingredient_3;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
        $this->ingredient_1 = Ingredient::factory()->create();
        $this->ingredient_2 = Ingredient::factory()->create();
        $this->ingredient_3 = Ingredient::factory()->create();
    }

    /**
     * @test
     */
    public function store()
    {
        $name = $this->faker->word();
        $price = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100);

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/dishes", [
            'name' => $name,
            'price' => $price,
            'ingredients' => [
                ['id' => $this->ingredient_1->id, 'quantity' => 50], 
                ['id' => $this->ingredient_2->id, 'quantity' => 50], 
                ['id' => $this->ingredient_3->id, 'quantity' => 50]
            ]
        ]);

        $response->assertStatus(200);

        /*
         * Check if the dishe exist in stock
         */

        $dishe = $this->restaurant->dishes()->first();
        $this->assertEquals($dishe->name, $name, 'Dishe name should be defined');
        $this->assertEquals($dishe->price, $price, 'Dishe price should be defined');

        /*
         * Clean the dishes of this restaurant
         */

        $dishe = Dishe::find($dishe->id);
        $this->restaurant->dishes()->detach();
        $dishe->delete();
    }

    /**
     * @test
     */
    public function store_DisheWithMultipleSameIngredient() {

        $name = $this->faker->word();
        $price = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100);

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/dishes", [
            'name' => $name,
            'price' => $price,
            'ingredients' => [
                ['id' => $this->ingredient_1->id, 'quantity' => 50], 
                ['id' => $this->ingredient_1->id, 'quantity' => 50]
            ]
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function update()
    {
        $dishe = Dishe::factory()->create();
        $dishe->ingredients()->attach([
            $this->ingredient_1->id,
            $this->ingredient_2->id,
            $this->ingredient_3->id
        ], ['quantity' => 50]);

        $this->restaurant->dishes()->attach($dishe->id);

        $response = $this->put("/api/restaurants/{$this->restaurant->id}/dishes", [
            'dishe_id' => $dishe->id,
            'name' => "update",
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'ingredients' => [
                ['id' => $this->ingredient_1->id, 'quantity' => 100]
            ]
        ]);

        $response->assertStatus(200);

        /*
         * Check if the dishe has been updated
         */

        $dishe = Dishe::find($dishe->id);
        $this->assertEquals($dishe->name, "update", 'Dishe name should be updated');

        /*
         * Clean the dishes of this restaurant
         */

        $this->restaurant->dishes()->detach();
        $dishe->delete();
    }

    /**
     * @test
     */
    public function update_DisheWhoDontExistInRestaurant()
    {
        $dishe = Dishe::factory()->create();
        $dishe->ingredients()->attach([
            $this->ingredient_1->id,
            $this->ingredient_2->id,
            $this->ingredient_3->id
        ], ['quantity' => 50]);

        $response = $this->put("/api/restaurants/{$this->restaurant->id}/dishes", [
            'dishe_id' => $dishe->id,
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'ingredients' => [
                ['id' => $this->ingredient_1->id, 'quantity' => 100]
            ]
        ]);

        $response->assertStatus(422);

        /*
         * Clean the dishes of this restaurant
         */

        $dishe->delete();
    }

    /**
     * @test
     */
    public function update_DisheWithMultipleSameIngredient()
    {
        $dishe = Dishe::factory()->create();
        $dishe->ingredients()->attach([
            $this->ingredient_1->id
        ], ['quantity' => 50]);

        $this->restaurant->dishes()->attach($dishe->id);

        $response = $this->put("/api/restaurants/{$this->restaurant->id}/dishes", [
            'dishe_id' => $dishe->id,
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'ingredients' => [
                ['id' => $this->ingredient_1->id, 'quantity' => 100],
                ['id' => $this->ingredient_1->id, 'quantity' => 100],
                ['id' => $this->ingredient_2->id, 'quantity' => 100]
            ]
        ]);

        $response->assertStatus(422);

        /*
         * Clean the dishes of this restaurant
         */

        $this->restaurant->dishes()->detach();
        $dishe->delete();
    }

    /**
     * @test
     */
    public function destroy()
    {
        $dishe = Dishe::factory()->create();
        $dishe->ingredients()->attach([
            $this->ingredient_1->id,
            $this->ingredient_2->id,
            $this->ingredient_3->id
        ], ['quantity' => 50]);

        $this->restaurant->dishes()->attach($dishe->id);

        $response = $this->delete("/api/restaurants/{$this->restaurant->id}/dishes", [
            'dishe_id' => $dishe->id
        ]);

        $response->assertStatus(200);

        /*
         * Check if the dishe has been deleted
         */

        $this->assertNull($this->restaurant->dishes->find($dishe->id), 'The dishe should be deleted of the restaurant');
        $this->assertNull(Dishe::find($dishe->id), 'The dishe should be deleted');
    }

    /**
     * @test
     */
    public function destroy_DisheWhoDontExistInRestaurant()
    {
        $dishe = Dishe::factory()->create();
        $dishe->ingredients()->attach([
            $this->ingredient_1->id,
            $this->ingredient_2->id,
            $this->ingredient_3->id
        ], ['quantity' => 50]);

        $response = $this->delete("/api/restaurants/{$this->restaurant->id}/dishes", [
            'dishe_id' => $dishe->id
        ]);

        $response->assertStatus(422);

        /*
         * Clean the dishe
         */

        $dishe->delete();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->restaurant->delete();
        $this->ingredient_1->delete();
        $this->ingredient_2->delete();
        $this->ingredient_3->delete();
    }
}
