<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DisheApiTest extends TestCase
{
    
    use WithFaker;

    /**
     * @test
     */
    public function store()
    {

        $response = $this->post('/api/restaurants/1/dishes', [
            'name' => 'test',
            'price' => 15.56,
            'ingredients' => [['id' => 3, 'quantity' => 5], ['id' => 6, 'quantity' => 5], ['id' => 10, 'quantity' => 5]]
        ]);

        $response->assertStatus(200);
    }

     /**
     * @test
     */
    public function update()
    {

        $response = $this->put('/api/restaurants/1/dishes', [
            'dishe_id' => Restaurant::find(1)->dishes->first()->id,
            'name' => 'updateTest',
            'price' => $this->faker->randomFloat($nbMaxDecimals = 3, $min = 0, $max = 100),
            'ingredients' => [['id' => 1, 'quantity' => 2], ['id' => 10, 'quantity' => 5]]
        ]);

        $response->assertStatus(200);
    }
}
