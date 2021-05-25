<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\Ingredient;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StockApiTest extends TestCase
{

    use WithFaker;

    protected $restaurant;
    protected $ingredient;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
        $this->ingredient = Ingredient::factory()->create();
    }

    /**
     * @test
     */
    public function index()
    {
        $response = $this->get("/api/restaurants/{$this->restaurant->id}/stock");
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function add_Ingredient() {
        
        //we delete all the already ingredients in the stock of this restaurant
        $this->restaurant->ingredients()->detach();

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/stock", [
            'ingredient_id' => $this->ingredient->id,
            'quantity' => 100
        ]);

        $response->assertStatus(200);

        /*
         * Check if the ingredient exist in stock
         */

        $ingredient_pivot = $this->restaurant->ingredients()->first();
        $this->assertEquals($ingredient_pivot->id, $this->ingredient->id, 'Ingredient id should be defined');
        $this->assertEquals($ingredient_pivot->pivot->quantity, 100, 'Quantity should be defined');

        /*
         * Clean the stock of this restaurant
         */

        $this->restaurant->ingredients()->detach();
    }

    /**
     * @test
     */
    public function add_IngredientAlreadyExistInStock() {

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/stock", [
            'ingredient_id' => $this->ingredient->id,
            'quantity' => 100
        ]);

        $response->assertStatus(200);

        /* 
         * try to insert the same ingredient
         */
        
        $response = $this->post("/api/restaurants/{$this->restaurant->id}/stock", [
            'ingredient_id' => $this->ingredient->id,
            'quantity' => 100
        ]);
        $response->assertStatus(409);

        /*
         * Clean the stock of this restaurant
         */

        $this->restaurant->ingredients()->detach();
    }

    /**
     * @test
     */
    public function add_IngredientWhoDontExistInDatabase() {

        /*
         * try to insert an ingredient who don't exist in database
         */

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/stock", [
            'ingredient_id' => 10000000,
            'quantity' => 100
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_IngredientWithNullObjectInsteadIdIngredient() {
        
        /*
         * try to insert an null object instead of ingredient id
         */

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/stock", [
            'ingredient_id' => null,
            'quantity' => 100
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_IngredientWithStringInsteadIdIngredient() {
        
        /*
         * try to insert an string instead of ingredient id
         */

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/stock", [
            'ingredient_id' => "string",
            'quantity' => 100
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_IngredientWithStringInsteadIngredientQuantity() {
        
        /*
         * try to insert an string instead of ingredient quantity
         */

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/stock", [
            'ingredient_id' => $this->ingredient->id,
            'quantity' => "string"
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_IngredientWithNullObjectInsteadIngredientQuantity() {
        
        /*
         * try to insert an null object instead of ingredient quantity
         */

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/stock", [
            'ingredient_id' => $this->ingredient->id,
            'quantity' => null
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_IngredientWithNegativeIngredientQuantity() {
        
        /*
         * try to insert an negative ingredient quantity
         */

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/stock", [
            'ingredient_id' => $this->ingredient->id,
            'quantity' => -50
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_Quantity() {

        //we add one ingredient to restaurant
        $this->restaurant->ingredients()->attach($this->ingredient->id, ['quantity' => 100]);

        /*
         * add quantity
         */

        $response = $this->put("/api/restaurants/{$this->restaurant->id}/stock", [
            'ingredient_id' => $this->ingredient->id,
            'quantity' => 100
        ]);

        $response->assertStatus(200);

        /*
         * Check if the quantity increased
         */

        $ingredient_pivot = $this->restaurant->ingredients()->first();
        $this->assertEquals($ingredient_pivot->pivot->quantity, 200, 'Quantity should be increase');

        /*
         * Clean the stock of this restaurant
         */

        $this->restaurant->ingredients()->detach();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->restaurant->delete();
        $this->ingredient->delete();
    }
}
