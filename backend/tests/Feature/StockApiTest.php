<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StockApiTest extends TestCase
{

    use WithFaker;

    /**
     * @test
     */
    public function index()
    {
        $response = $this->get('/api/restaurants/1/stock');
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function add_Ingredient() {

        $restaurant = Restaurant::latest('id')->first();
        
        //we delete all the already ingredients in the stock of this restaurant
        $restaurant->ingredients()->detach();

        $ingredientId = rand(1, 20);
        $quantity = rand(0, 100);

        $response = $this->post("/api/restaurants/{$restaurant->id}/stock", [
            'ingredient_id' => $ingredientId,
            'quantity' => $quantity
        ]);

        $response->assertStatus(200);

        /*
         * Check if the ingredient exist in stock
         */

        $ingredient = $restaurant->ingredients()->find($ingredientId);
        $this->assertEquals($ingredient->id, $ingredientId, 'Ingredient should be inserted in stock of the Restaurant');
        $this->assertEquals($ingredient->pivot->quantity, $quantity, 'Quantity should be defined');

        /*
         * Clean the stock of this restaurant
         */

        $restaurant->ingredients()->detach();
    }

    /**
     * @test
     */
    public function add_IngredientAlreadyExistInStock() {
        
        /*
         *Add ingredient in stock of the latest restaurant (order id)
         */

        $restaurant = Restaurant::latest('id')->first();
        
        //we delete all the already ingredients in the stock of this restaurant
        $restaurant->ingredients()->detach();

        $ingredientId = rand(1, 20);
        $quantity = rand(0, 100);

        $response = $this->post("/api/restaurants/{$restaurant->id}/stock", [
            'ingredient_id' => $ingredientId,
            'quantity' => $quantity
        ]);

        $response->assertStatus(200);

        /* 
         * try to insert the same ingredient
         */
        
        $response = $this->post("/api/restaurants/{$restaurant->id}/stock", [
            'ingredient_id' => $ingredientId,
            'quantity' => $quantity
        ]);
        $response->assertStatus(409);
    }

    /**
     * @test
     */
    public function add_IngredientWhoDontExistInDatabase() {

        $restaurant = Restaurant::latest('id')->first();
        $quantity = rand(0, 100);

        /*
         * try to insert an ingredient who don't exist in database
         */

        $response = $this->post("/api/restaurants/{$restaurant->id}/stock", [
            'ingredient_id' => 10000000,
            'quantity' => $quantity
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_IngredientWithNullObjectInsteadIdIngredient() {

        $restaurant = Restaurant::latest('id')->first();
        $quantity = rand(0, 100);
        
        /*
         * try to insert an null object instead of ingredient id
         */

        $response = $this->post("/api/restaurants/{$restaurant->id}/stock", [
            'ingredient_id' => null,
            'quantity' => $quantity
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_IngredientWithStringInsteadIdIngredient() {

        $restaurant = Restaurant::latest('id')->first();
        $quantity = rand(0, 100);
        
        /*
         * try to insert an string instead of ingredient id
         */

        $response = $this->post("/api/restaurants/{$restaurant->id}/stock", [
            'ingredient_id' => "string",
            'quantity' => $quantity
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_IngredientWithStringInsteadIngredientQuantity() {
        
        $restaurant = Restaurant::latest('id')->first();

        //we delete all the already ingredients in the stock of this restaurant
        $restaurant->ingredients()->detach();

        $ingredientId = rand(1, 20);

        /*
         * try to insert an string instead of ingredient quantity
         */

        $response = $this->post("/api/restaurants/{$restaurant->id}/stock", [
            'ingredient_id' => $ingredientId,
            'quantity' => "string"
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_IngredientWithNullObjectInsteadIngredientQuantity() {
        
        $restaurant = Restaurant::latest('id')->first();

        //we delete all the already ingredients in the stock of this restaurant
        $restaurant->ingredients()->detach();

        $ingredientId = rand(1, 20);

        /*
         * try to insert an null object instead of ingredient quantity
         */

        $response = $this->post("/api/restaurants/{$restaurant->id}/stock", [
            'ingredient_id' => $ingredientId,
            'quantity' => null
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function add_Quantity() {

        $restaurant = Restaurant::latest('id')->first();

        //we delete all the already ingredients in the stock of this restaurant
        $restaurant->ingredients()->detach();

        $ingredientId = rand(1, 20);
        $quantity = rand(0, 100);

        //we add one ingredient to restaurant
        $restaurant->ingredients()->attach($ingredientId, ['quantity' => $quantity]);

        /*
         * add quantity
         */

        $response = $this->put("/api/restaurants/{$restaurant->id}/stock", [
            'ingredient_id' => $ingredientId,
            'quantity' => $quantity
        ]);

        $response->assertStatus(200);

        /*
         * Check if the quantity increased
         */

        $ingredient = $restaurant->ingredients()->find($ingredientId);
        $this->assertEquals($ingredient->pivot->quantity, $quantity * 2, 'Quantity should be increase');

        /*
         * Clean the stock of this restaurant
         */

        $restaurant->ingredients()->detach();
    }
}
