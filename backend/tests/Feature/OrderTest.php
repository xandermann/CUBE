<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\Dishe;
use App\Models\Menu;
use App\Models\Ingredient;
use App\Models\Order;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class OrderTest extends TestCase
{

    use WithFaker;

    protected $restaurant;
    protected $user;
    protected $menu_1;
    protected $menu_2;
    protected $dishe_1;
    protected $dishe_2;
    protected $ingredient_1;
    protected $ingredient_2;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);

        $this->ingredient_1 = Ingredient::factory()->create();
        $this->restaurant->ingredients()->attach($this->ingredient_1->id, ['quantity' => 200]);

        $this->ingredient_2 = Ingredient::factory()->create();
        $this->restaurant->ingredients()->attach($this->ingredient_2->id, ['quantity' => 200]);

        $this->dishe_1 = Dishe::factory()->create();
        $this->dishe_1->ingredients()->attach($this->ingredient_1->id, ['quantity' => 5]);
        $this->restaurant->dishes()->attach($this->dishe_1->id);

        $this->dishe_2 = Dishe::factory()->create();
        $this->dishe_2->ingredients()->attach([
            $this->ingredient_1->id,
            $this->ingredient_2->id
        ], ['quantity' => 3]);
        $this->restaurant->dishes()->attach($this->dishe_2->id);

        $this->menu_1 = Menu::factory()->create();
        $this->menu_1->dishes()->attach($this->dishe_1->id);
        $this->restaurant->menus()->attach($this->menu_1->id);

        $this->menu_2 = Menu::factory()->create();
        $this->menu_2->dishes()->attach([
            $this->dishe_1->id,
            $this->dishe_2->id
        ]);
        $this->restaurant->menus()->attach($this->menu_2->id);
    }

    /**
     * @test
     */
    public function store()
    {
        $date = $this->faker->dateTime($max = 'now', $timezone = null);

        $response = $this->post("/api/orders", [
            'restaurant_id' => $this->restaurant->id,
            // 'user_id' => $this->user->id,
            'date' => $date,
            'dishes' => [
                ['id' => $this->dishe_1->id, 'quantity' => 2],
                ['id' => $this->dishe_2->id, 'quantity' => 2]
            ],
            'menus' => [
                ['id' => $this->menu_1->id, 'quantity' => 2],
                ['id' => $this->menu_2->id, 'quantity' => 2]
            ]
        ]);

        $response->assertStatus(200);


        /*
         * Check if the dishe exist in stock
         */

        $order = Order::latest('id')->first();
        $this->assertEquals($order->date, $date->format('Y-m-d H:i:s'), 'Order date should be defined');

        $total_price = ($this->dishe_1->price * 2) + ($this->dishe_2->price * 2) + ($this->menu_1->price * 2) + ($this->menu_2->price * 2);
        $this->assertEquals($order->total_price, $total_price, 'Price order should be defined.');

        $stock_ingredient_1 = $this->restaurant->ingredients()->find($this->ingredient_1->id);
        $this->assertEquals($stock_ingredient_1->pivot->quantity, 200 - 3*(2*5) - 2*(2*3), 'Stock for the ingredient 1 should be deducted.');

        $stock_ingredient_2 = $this->restaurant->ingredients()->find($this->ingredient_2->id);
        $this->assertEquals($stock_ingredient_2->pivot->quantity, 200 - 2*(2*3), 'Stock for the ingredient 2 should be deducted.');

        /*
         * Clean the dishes of this restaurant
         */
        $order->delete();

    }

    /**
     * @test
     */
    public function store_restaurantDoesNotHaveEnoughIngredientsInStock()
    {
        $date = $this->faker->dateTime($max = 'now', $timezone = null);

        $response = $this->post("/api/orders", [
            'restaurant_id' => $this->restaurant->id,
            'date' => $date,
            'dishes' => [
                ['id' => $this->dishe_1->id, 'quantity' => 100],
                ['id' => $this->dishe_2->id, 'quantity' => 100]
            ],
            'menus' => [
                ['id' => $this->menu_1->id, 'quantity' => 100],
                ['id' => $this->menu_2->id, 'quantity' => 100]
            ]
        ]);

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function store_orderWithMultipleSameDishe()
    {
        $date = $this->faker->dateTime($max = 'now', $timezone = null);

        $response = $this->post("/api/orders", [
            'restaurant_id' => $this->restaurant->id,
            'date' => $date,
            'dishes' => [
                ['id' => $this->dishe_1->id, 'quantity' => 2],
                ['id' => $this->dishe_1->id, 'quantity' => 2],
                ['id' => $this->dishe_2->id, 'quantity' => 2]
            ],
            'menus' => []
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['dishes.0.id','dishes.1.id']);
    }

    /**
     * @test
     */
    public function store_whenDateIsString()
    {
        $response = $this->post("/api/orders", [
            'restaurant_id' => $this->restaurant->id,
            'date' => "string",
            'dishes' => [
                ['id' => $this->dishe_1->id, 'quantity' => 100],
                ['id' => $this->dishe_2->id, 'quantity' => 100]
            ],
            'menus' => [
                ['id' => $this->menu_1->id, 'quantity' => 100],
                ['id' => $this->menu_2->id, 'quantity' => 100]
            ]
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('date');
    }

    public function tearDown(): void
    {
        $this->restaurant->coordinate()->delete();
        $this->restaurant->delete();
        $this->user->coordinate()->delete();
        $this->user->delete();
        $this->menu_1->delete();
        $this->menu_2->delete();
        $this->dishe_1->delete();
        $this->dishe_2->delete();
        $this->ingredient_1->delete();
        $this->ingredient_2->delete();
        parent::tearDown();
    }
}
