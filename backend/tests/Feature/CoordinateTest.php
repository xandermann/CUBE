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

class CoordinateTest extends TestCase
{
    /**
     * @test
     */
    public function index()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->get('/api/coordinates');

        $response->assertStatus(200);
    }
}
