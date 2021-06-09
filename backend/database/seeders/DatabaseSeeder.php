<?php

namespace Database\Seeders;

use App\Models\{ Coordinate, User, Restaurant, Ingredient, Dishe, Menu, Order, Complaint};
use App\Http\Controllers\{RestaurantController, OrderController};
use App\Http\Requests\OrderRequests\OrderPostRequest;
use App\Http\Requests\RestaurantRequests\RestaurantPostRequest;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

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

        // test account
        $coordinate = Coordinate::create([
            'full_address' => 'Nancy, rue X no 1',
            'city' => 'Nancy',
            'postal_code' => '54000',
            'lat_address' => null,
            'lng_address' => null,
            'number_phone' => null,
            'country' => 'France',
        ]);

        $user = User::create([
            'lastname' => 'Doe',
            'firstname' => 'John',
            'email' => 'john.doe@gmail.com',
            'password' => Hash::make('examplepassword'),
            'is_admin' => true,
            'coordinate_id' => $coordinate->id,
            'email_verified_at' => Carbon::yesterday(),
        ]);

        Sanctum::actingAs($user);

        //populate the ingrédients
        $oeuf = Ingredient::create([
            'name' => 'Oeuf'
        ]);
        $creme = Ingredient::create([
            'name' => 'Crème'
        ]);
        $pate = Ingredient::create([
            'name' => 'Pâte'
        ]);
        $lardon = Ingredient::create([
            'name' => 'Lardon'
        ]);
        $tomate = Ingredient::create([
            'name' => 'Tomate'
        ]);
        $salade = Ingredient::create([
            'name' => 'Salade'
        ]);
        $oignon = Ingredient::create([
            'name' => 'Oignon'
        ]);
        $frite = Ingredient::create([
            'name' => 'Frite'
        ]);
        $steak = Ingredient::create([
            'name' => 'Steak'
        ]);

        
        //populate the restaurants
        (new RestaurantController)->store(new RestaurantPostRequest([
            'name' => "Retrogusto",
            'full_address' => "40 Rue Stanislas",
            'city' => "Nancy",
            'postal_code' => "54000",
            'lat_address' => null,
            'lng_address' => null,
            'number_phone' => "0383341953",
            'country' => "France",
        ]));
        $restaurant = Restaurant::latest('id')->first();
            
        //stock
        $restaurant->ingredients()->attach($pate->id, ['quantity' => 25000]); //25 Kg
        $restaurant->ingredients()->attach($creme->id, ['quantity' => 360]); //360 Cl
        $restaurant->ingredients()->attach($lardon->id, ['quantity' => 1860]); //1 Kg 860
        $restaurant->ingredients()->attach($oeuf->id, ['quantity' => 100]); //100 U
        
        //dishes
        $pateCarbo = Dishe::create([
            'name' => 'Pâtes à la carbonara',
            'price' => 7.99
        ]);
        $pateCarbo->ingredients()->attach($pate->id, ['quantity' => 125]);
        $pateCarbo->ingredients()->attach($creme->id, ['quantity' => 12]);
        $pateCarbo->ingredients()->attach($lardon->id, ['quantity' => 62]);
        $restaurant->dishes()->attach($pateCarbo->id);

        $pateOeuf = Dishe::create([
            'name' => 'Pâtes aux oeufs',
            'price' => 6
        ]);
        $pateOeuf->ingredients()->attach($pate->id, ['quantity' => 125]);
        $pateOeuf->ingredients()->attach($oeuf->id, ['quantity' => 3]);
        $restaurant->dishes()->attach($pateOeuf->id);
        
        //menus
        $menu = Menu::create([
            'name' => 'Menus pâtes',
            'price' => 10
        ]);
        $menu->dishes()->attach($pateCarbo);
        $menu->dishes()->attach($pateOeuf);
        $restaurant->menus()->attach($menu->id);

        //multiple reviews by one user
        $user->restaurants()->attach($restaurant, ['note' => 4.5, 'message' => "très bon restaurant"]);
        $user->restaurants()->attach($restaurant, ['note' => 2.0, 'message' => "mauvaise livraison"]);
        $user->restaurants()->attach($restaurant, ['note' => 0, 'message' => "la commande n'est pas arrivé depuis 5h"]);
        $restaurant->note = round( (6.5/ 3) , 1);
        $restaurant->save();

        //orders
        (new OrderController)->store(new OrderPostRequest([
            'restaurant_id' => $restaurant->id,
            'date' => now(),
            'dishes' => [
                ['id' => $pateCarbo->id, 'quantity' => 1]
            ],
            'menus' => []
        ]));
        


        //new restaurants
        (new RestaurantController)->store(new RestaurantPostRequest([
            'name' => "L'Entrecôte Stanislas",
            'full_address' => "23 Rue Stanislas",
            'city' => "Nancy",
            'postal_code' => "54000",
            'lat_address' => null,
            'lng_address' => null,
            'number_phone' => "0383382190",
            'country' => "France",
        ]));
        $restaurant2 = Restaurant::latest('id')->first();
            
        //stock
        $restaurant2->ingredients()->attach($frite->id, ['quantity' => 25000]); //25 Kg
        $restaurant2->ingredients()->attach($steak->id, ['quantity' => 50]); //50 U
        
        //dishes
        $steakFrite = Dishe::create([
            'name' => 'Steak frites',
            'price' => 10
        ]);
        $steakFrite->ingredients()->attach($frite->id, ['quantity' => 125]);
        $steakFrite->ingredients()->attach($steak->id, ['quantity' => 1]);
        $restaurant2->dishes()->attach($steakFrite->id);
        
        //menus
        $menuSteakFrite = Menu::create([
            'name' => 'Steak frites',
            'price' => 10
        ]);
        $menuSteakFrite->dishes()->attach($steakFrite);
        $restaurant2->menus()->attach($menuSteakFrite->id);

        //multiple reviews by one user
        $user->restaurants()->attach($restaurant2, ['note' => 5, 'message' => "restaurant au top !"]);
        $user->restaurants()->attach($restaurant2, ['note' => 4.5, 'message' => "très bon restaurant !"]);
        $restaurant2->note = round( (9.5/ 2) , 1);
        $restaurant2->save();

        //orders
        (new OrderController)->store(new OrderPostRequest([
            'restaurant_id' => $restaurant2->id,
            'date' => now(),
            'dishes' => [],
            'menus' => [
                ['id' => $menuSteakFrite->id, 'quantity' => 1]
            ]
        ]));
        
        //---------------aléatoire----------------
        /*
        $ids = range(1,9);

        //populate the dishes with their ingredients (random)
        Dishe::factory()->count(20)->create()->each(function ($dishe) use($ids) {
            shuffle($ids);
            $dishe->ingredients()->attach(array_slice($ids, 0, rand(1, 4)), ['quantity' => rand(0, 5)]);
        });

        //populate the menus with their dishes (random)
        Menu::factory()->count(20)->create()->each(function ($menu) use($ids) {
            shuffle($ids);
            $menu->dishes()->attach(array_slice($ids, 0, rand(1, 3)));
        });

        //populate the restaurants with ingredients and dishes (random)
        Restaurant::factory()->count(90)->create()->each(function ($restaurant) use($ids, $user) {
            shuffle($ids);
            $restaurant->ingredients()->attach(array_slice($ids, 0, rand(1, 3)), ['quantity' => rand(0, 100)]);
            shuffle($ids); //we remix for the dishes
            $restaurant->dishes()->attach(array_slice($ids, 0, rand(1, 3)));
            shuffle($ids); //we remix for the menus
            $restaurant->menus()->attach(array_slice($ids, 0, rand(1, 3)));

            //populate the orders with new restaurants and users
            Order::factory()
            ->has(Complaint::factory()->count(3))
            ->create([
                'user_id' => $user->id,
                'restaurant_id' => $restaurant->id,
            ])
            ->each(function ($order) use($ids) {
                shuffle($ids); //we remix for the dishes
                $order->dishes()->attach(array_slice($ids, 0, rand(1, 3)), ['quantity' => rand(1, 3)]);
                shuffle($ids); //we remix for the menus
                $order->menus()->attach(array_slice($ids, 0, rand(0, 2)), ['quantity' => rand(1, 2)]);
                /*$order->restaurant_id = Restaurant::find(rand(1, 100))->id;
                $order->save();
            });
        });*/

        
    }
}
