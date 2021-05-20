<?php

namespace Database\Seeders;

use App\Models\Coordinate;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Ingredient;
use App\Models\Dishe;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(100)->create();

        // Compte de test
        $coordinate = Coordinate::create([
            'full_address' => 'Nancy, rue X no 1',
            'city' => 'Nancy',
            'postal_code' => '54000',
            'lat_address' => null,
            'lng_address' => null,
            'number_phone' => null,
            'country' => 'France',
        ]);

        User::create([
            'lastname' => 'Doe',
            'firstname' => 'John',
            'email' => 'a@a.a',
            'password' => Hash::make('a'),
            'is_admin' => true,
            'coordinate_id' => $coordinate->id,
            'email_verified_at' => Carbon::yesterday(),
        ]);

        //population des ingrédients
        Ingredient::factory()->count(20)->create();

        //population des restaurants avec les ingrédients liés (random)
        $ids = range(1, 20);
        Restaurant::factory()->count(100)->create()->each(function ($restaurant) use($ids) {
            shuffle($ids);
            $restaurant->ingredients()->attach(array_slice($ids, 0, rand(1, 3)), ['quantity' => rand(0, 100)]);
        });

        //population des plats avec les ingrédients (random)
        Dishe::factory()->count(30)->create()->each(function ($dishe) use($ids) {
            shuffle($ids);
            $dishe->ingredients()->attach(array_slice($ids, 0, rand(1, 4)), ['quantity' => rand(0, 5)]);
        });
    }
}
