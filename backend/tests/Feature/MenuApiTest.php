<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\Dishe;
use App\Models\Ingredient;
use App\Models\Menu;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MenuApiTest extends TestCase
{
    
    use WithFaker;

    protected $restaurant;
    protected $dishe_1;
    protected $dishe_2;
    protected $ingredient_1;
    protected $ingredient_2;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
        $this->ingredient_1 = Ingredient::factory()->create();
        $this->ingredient_2 = Ingredient::factory()->create();

        $this->dishe_1 = Dishe::factory()->create();
        $this->dishe_1->ingredients()->attach($this->ingredient_1->id, ['quantity' => 100]);

        $this->dishe_2 = Dishe::factory()->create();
        $this->dishe_2->ingredients()->attach([
            $this->ingredient_1->id,
            $this->ingredient_2->id
        ], ['quantity' => 50]);
    }

    /**
     * @test
     */
    public function store()
    {
        $name = $this->faker->word();
        $price = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100);

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/menus", [
            'name' => $name,
            'price' => $price,
            'dishes' => [
                ['id' => $this->dishe_1->id], 
                ['id' => $this->dishe_2->id]
            ]
        ]);

        $response->assertStatus(200);

        /*
         * Check if the menu exist in restaurant
         */

        $menu = $this->restaurant->menus()->first();
        $this->assertEquals($menu->name, $name, 'Menu name should be defined');
        $this->assertEquals($menu->price, $price, 'Menu price should be defined');

        /*
         * Clean the menu
         */

        $menu = Menu::find($menu->id);
        $menu->delete();
    }

    /**
     * @test
     */
    public function store_MenuWithMultipleSameDishe() {

        $name = $this->faker->word();
        $price = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100);

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/menus", [
            'name' => $name,
            'price' => $price,
            'dishes' => [
                ['id' => $this->dishe_1->id], 
                ['id' => $this->dishe_1->id]
            ]
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function store_MenuWithDishesNotExistInDatabase() {

        $name = $this->faker->word();
        $price = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100);

        $response = $this->post("/api/restaurants/{$this->restaurant->id}/menus", [
            'name' => $name,
            'price' => $price,
            'dishes' => [
                ['id' => 10000], 
                ['id' => 20000]
            ]
        ]);
        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function update()
    {
        $menu = Menu::factory()->create();
        $menu->dishes()->attach([
            $this->dishe_1->id,
            $this->dishe_2->id
        ]);

        $this->restaurant->menus()->attach($menu->id);

        $response = $this->put("/api/restaurants/{$this->restaurant->id}/menus", [
            'menu_id' => $menu->id,
            'name' => "update",
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'dishes' => [
                ['id' => $this->dishe_1->id]
            ]
        ]);

        $response->assertStatus(200);

        /*
         * Check if the menu has been updated
         */

        $menu = Menu::find($menu->id);
        $this->assertEquals($menu->name, "update", 'Menu name should be updated');

        /*
         * Clean the menu
         */

        $this->restaurant->menus()->detach();
        $menu->delete();
    }

    /**
     * @test
     */
    public function update_MenuWhoDontExistInRestaurant()
    {
        $menu = Menu::factory()->create();
        $menu->dishes()->attach([
            $this->dishe_1->id,
            $this->dishe_2->id
        ]);

        $response = $this->put("/api/restaurants/{$this->restaurant->id}/menus", [
            'menu_id' => $menu->id,
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'dishes' => [
                ['id' => $this->dishe_1->id]
            ]
        ]);

        $response->assertStatus(422);

        /*
         * Clean the menu
         */

        $menu->delete();
    }

    /**
     * @test
     */
    public function update_MenuWithMultipleSameDishe()
    {
        $menu = Menu::factory()->create();
        $menu->dishes()->attach([
            $this->dishe_1->id
        ]);

        $this->restaurant->menus()->attach($menu->id);

        $response = $this->put("/api/restaurants/{$this->restaurant->id}/menus", [
            'menu_id' => $menu->id,
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'dishes' => [
                ['id' => $this->dishe_1->id],
                ['id' => $this->dishe_1->id],
                ['id' => $this->dishe_2->id]
            ]
        ]);

        $response->assertStatus(422);

        /*
         * Clean the menu
         */

        $this->restaurant->menus()->detach();
        $menu->delete();
    }

    /**
     * @test
     */
    public function update_MenuWithDishesNotExistInDatabase()
    {
        $menu = Menu::factory()->create();
        $menu->dishes()->attach([
            $this->dishe_1->id
        ]);

        $this->restaurant->menus()->attach($menu->id);

        $response = $this->put("/api/restaurants/{$this->restaurant->id}/menus", [
            'menu_id' => $menu->id,
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'dishes' => [
                ['id' => 1000],
                ['id' => 2000]
            ]
        ]);

        $response->assertStatus(422);

        /*
         * Clean the menu
         */

        $this->restaurant->menus()->detach();
        $menu->delete();
    }

    /**
     * @test
     */
    public function destroy()
    {
        $menu = Menu::factory()->create();
        $menu->dishes()->attach([
            $this->dishe_1->id,
            $this->dishe_2->id
        ]);

        $this->restaurant->menus()->attach($menu->id);

        $response = $this->delete("/api/restaurants/{$this->restaurant->id}/menus", [
            'menu_id' => $menu->id
        ]);

        $response->assertStatus(200);

        /*
         * Check if the menu has been deleted
         */

        $this->assertNull($this->restaurant->menus->find($menu->id), 'The menu should be deleted of the restaurant');
        $this->assertNull(Menu::find($menu->id), 'The menu should be deleted');
    }

    /**
     * @test
     */
    public function destroy_MenuWhoDontExistInRestaurant()
    {
        $menu = Menu::factory()->create();
        $menu->dishes()->attach([
            $this->dishe_1->id,
            $this->dishe_2->id
        ]);

        $response = $this->delete("/api/restaurants/{$this->restaurant->id}/menus", [
            'menu_id' => $menu->id
        ]);

        $response->assertStatus(422);

        /*
         * Clean the menu
         */

        $menu->delete();
    }

    /**
     * @test
     */
    public function destroy_MenuNotExistInDatabase()
    {
        $response = $this->delete("/api/restaurants/{$this->restaurant->id}/menus", [
            'menu_id' => 1000
        ]);

        $response->assertStatus(422);
    }

    public function tearDown(): void
    {
        $this->restaurant->coordinate()->delete();
        $this->restaurant->delete();
        $this->dishe_1->delete();
        $this->dishe_2->delete();
        $this->ingredient_1->delete();
        $this->ingredient_2->delete();
        parent::tearDown();
    }
}
