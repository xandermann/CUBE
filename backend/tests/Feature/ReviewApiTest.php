<?php

namespace Tests\Feature;

use App\Models\{Restaurant, User};
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewApiTest extends TestCase
{

    use WithFaker;

    protected $restaurant;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
        $this->user = User::factory()->create();
    }

    /**
     * @test
     */
    public function index_restaurant()
    {
        $response = $this->get("/api/restaurants/{$this->restaurant->id}/reviews");
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function index_user()
    {
        $response = $this->get("/api/users/{$this->user->id}/reviews");
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function store() {

        $message = $this->faker->text($maxNbChars = 200);
        $note = $this->faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5);

        $response = $this->post("/api/users/{$this->user->id}/reviews", [
            'restaurant_id' => $this->restaurant->id,
            'note' => $note,
            'message' => $message,
        ]);

        $response->assertStatus(200);

        /*
         * Check if the ingredient exist in stock
         */

        $review = $this->user->restaurants()->first();
        $this->restaurant->refresh(); //we refresh the model to have the restaurant's note up to date
        $this->assertEquals($review->pivot->note, $note, 'Review note should be defined');
        $this->assertEquals($review->pivot->message, $message, 'Review message should be defined');
        $this->assertEquals($this->restaurant->note, $note, 'Restaurant note should be updated');

        /*
         * let's test the average of 2 reviews
         */
        $note2 = $this->faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5);
        $response = $this->post("/api/users/{$this->user->id}/reviews", [
            'restaurant_id' => $this->restaurant->id,
            'note' => $note2,
            'message' => $this->faker->text($maxNbChars = 200),
        ]);
        $response->assertStatus(200);

        $this->restaurant->refresh(); //we refresh the model to have the restaurant's note up to date
        $this->assertEquals($this->restaurant->note, round( ($note + $note2) / 2, 1), 'Restaurant note should be updated');

        /*
         * Clean the reviews of the restaurant
         */

        $this->restaurant->users()->detach();
    }

    /**
     * @test
     */
    public function store_withRestaurantThatDoesNotExist()
    {
        $message = $this->faker->text($maxNbChars = 200);
        $note = $this->faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5);

        $response = $this->post("/api/users/{$this->user->id}/reviews", [
            'restaurant_id' => 1000,
            'note' => $note,
            'message' => $message,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('restaurant_id');
    }

    /**
     * @test
     */
    public function store_noteWithMultipleDecimalDigits()
    {
        $message = $this->faker->text($maxNbChars = 200);
        $note = 4.123456789;

        $response = $this->post("/api/users/{$this->user->id}/reviews", [
            'restaurant_id' => $this->restaurant->id,
            'note' => $note,
            'message' => $message,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('note');
    }

    /**
     * @test
     */
    public function store_noteThatIsNotInInterval()
    {
        $message = $this->faker->text($maxNbChars = 200);
        $note = 5.1;

        $response = $this->post("/api/users/{$this->user->id}/reviews", [
            'restaurant_id' => $this->restaurant->id,
            'note' => $note,
            'message' => $message,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('note');
    }

    /**
     * @test
     */
    public function store_messageThatIsNotString()
    {
        $message = 1000;
        $note = $this->faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 5);

        $response = $this->post("/api/users/{$this->user->id}/reviews", [
            'restaurant_id' => $this->restaurant->id,
            'note' => $note,
            'message' => $message,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('message');
    }

    public function tearDown(): void
    {
        $this->restaurant->coordinate()->delete();
        $this->restaurant->delete();
        $this->user->coordinate()->delete();
        $this->user->delete();
        parent::tearDown();
    }
}
