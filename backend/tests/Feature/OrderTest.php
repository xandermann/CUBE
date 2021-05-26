<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\Dishe;
use App\Models\Ingredient;
use App\Models\Order;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{

    use WithFaker;

    protected $restaurant;
    protected $user;
    protected $dishe_1;
    protected $dishe_2;
    protected $ingredient_1;
    protected $ingredient_2;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
        $this->user = User::factory()->create();
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
        $date = $this->faker->date($format = 'Y-m-d', $max = 'now');
        $total_price = $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100);
        
        $response = $this->post("/api/orders", [
            'restaurant_id' => $this->restaurant->id,
            'user_id' => $this->user->id,
            'date' => $date,
            'total_price' => $total_price,
            'dishes' => [
                ['id' => $this->dishe_1->id, 'quantity' => 1], 
                ['id' => $this->dishe_2->id, 'quantity' => 2]
            ],
            'menus' => []
        ]);

        $response->assertStatus(200);

        
        /*
         * Check if the dishe exist in stock
         */

        $order = Order::latest('id')->first();
        $this->assertEquals($order->date, $date, 'Order date should be defined');
        $this->assertEquals($order->total_price, $total_price, 'Order price should be defined');
        
        /*
         * Clean the dishes of this restaurant
         */
        $order->delete();
        
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->restaurant->delete();
        $this->user->delete();
        $this->dishe_1->delete();
        $this->dishe_2->delete();
        $this->ingredient_1->delete();
        $this->ingredient_2->delete();
    }
}
