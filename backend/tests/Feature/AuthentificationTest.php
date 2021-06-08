<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthentificationTest extends TestCase
{
    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function fetch_xsrf_token()
    {
        $response = $this->get('/sanctum/csrf-cookie');

        $response->assertStatus(204);

        $response->assertCookie("XSRF-TOKEN");
    }

    /**
     * @test
     */
    public function not_logged_and_want_access_to_api()
    {
        $response = $this->get('/api/user');

        $response->assertRedirect();
    }

    /**
     * @test
     */
    public function login_is_ok() {
        $user = User::factory()->create();

        $CsrfResponse = $this->get('/sanctum/csrf-cookie');

        $loginResponse = $this
        ->withCookies($CsrfResponse->headers->getCookies())
        ->post('/login', [
            'email' => $user->email,
            'password' => $user->email,
        ], [
            "Accept" => 'application/json',
        ]);

        $loginResponse->assertStatus(200);

        $user->coordinate()->delete();
        $user->delete();
    }

    /**
     * @test
     */
    public function login_with_wrong_credential()
    {
        $CsrfResponse = $this->get('/sanctum/csrf-cookie');

        $loginResponse = $this
        ->withCookies($CsrfResponse->headers->getCookies())
        ->post('/login', [
            'email' => 'wrong@wrong.fr',
            'password' => 'wrong',
        ], [
            "Accept" => 'application/json',
        ]);

        $loginResponse->assertStatus(422);
    }

    /**
     * @test
     */
    public function logged_in_and_fetch_from_api() {
        $user = User::factory()->create();

        $CsrfResponse = $this->get('/sanctum/csrf-cookie');

        $loginResponse = $this
        ->withCookies($CsrfResponse->headers->getCookies())
        ->post('/login', [
            'email' => $user->email,
            'password' => $user->email,
        ], [
            "Accept" => 'application/json',
        ]);

        $loginResponse->assertStatus(200);

        $apiResponse = $this
        ->withCookies($loginResponse->headers->getCookies())
        ->get('/api/user');

        $apiResponse->assertStatus(200);

        $apiResponse->assertJsonFragment(['email' => $user->email]);

        $user->coordinate()->delete();
        $user->delete();
    }

}
