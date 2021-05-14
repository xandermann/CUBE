<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Ingredient;
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
        
        //population des ingrédients
        Ingredient::factory()->count(20)->create();

        //population des restaurants avec les ingrédients liés (random)
        $ids = range(1, 20);
        Restaurant::factory()->count(100)->create()->each(function ($restaurant) use($ids) {
            shuffle($ids);
            $restaurant->ingredients()->attach(array_slice($ids, 0, rand(1, 3)), ['quantity' => rand(0, 100)]);
        });

        /*
        User::insert([
            'email' => 'a@a',
            'password' => Hash::make('a'),
            'lastname' => 'a',
            'firstname' => 'a',
            'country' => 'France',
            'city' => 'Nancy',
            'postcode' => '54000',
            'street' => 'rue blabla',
            'language' => 'fr',
            'is_admin' => '1',
            "email_verified_at" => now(),
        ]);


        // Supplier::insert([
        //     'nomFournisseur' => 'jean-mi',
        //     'adresseFournisseur' => 'petaoushnock',
        //     'categorieFournisseur' => 'nourriture'
        // ]);


        // Franchise::insert([
        //     'franchise' => '1'
        // ]);


        Restaurant::insert([
            'nomRestaurant' => 'la bouffe',
            'adresseRestaurant' => 'adresse de la rue du resto',
            'numRestaurant' => 'numTest',
            'idFranchise' => 1
        ]);
        */


    }
}
