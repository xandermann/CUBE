<?php

namespace Tests\Feature;

use App\Models\{Complaint, Order, Restaurant, User};
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ComplaintApiTest extends TestCase
{

    use WithFaker;

    protected $order;

    public function setUp(): void
    {
        parent::setUp();
        $this->order = Order::factory()->create();
    }
    
    /**
     * @test
     */
    public function store()
    {
        $message = $this->faker->text($maxNbChars = 200);
        $date = $this->faker->dateTime($max = 'now', $timezone = null);

        $response = $this->post("/api/complaints", [
            'order_id' => $this->order->id,
            'message' => $message,
            'date' => $date
        ]);

        $response->assertStatus(200);

        /*
         * Check if the complaint exist
         */

        $complaint = $this->order->complaints()->first();
        $this->assertEquals($complaint->message, $message, 'Complaint message should be defined');
        $this->assertEquals($complaint->date, $date->format('Y-m-d H:i:s'), 'Complaint date should be defined');

        /*
         * Clean the complaint
         */

        $complaint->delete();
    }

    public function tearDown(): void
    {
        $restaurant = Restaurant::find($this->order->restaurant->id);
        $user = User::find($this->order->user->id);
        $restaurant->coordinate()->delete();
        $user->coordinate()->delete();
        $restaurant->delete();
        $user->delete();
        $this->order->delete();
        parent::tearDown();
    }
}
