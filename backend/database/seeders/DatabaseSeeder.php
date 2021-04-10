<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
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
        // \App\Models\User::factory(10)->create();

        User::insert([
            'email' => 'a@a',
            'password' => Hash::make('a'),
            'lastname' => 'a',
            'firstname' => 'a',
            'country' => 'France',
            'city' => 'Nancy',
            'postcode' => 54000,
            'street' => 'a',
            'language' => 'fr',
            'is_admin' => true,
        ]);

        Restaurant::insert([
            'user_id' => 1,
            'is_franchisees' => false
        ]);
    }
}
