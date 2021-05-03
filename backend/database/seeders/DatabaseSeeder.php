<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Supplier;
use App\Models\Franchise;
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
            'emailUtilisateur' => 'a@a',
            'mdpUtilisateur' => Hash::make('a'),
            'nomUtilisateur' => 'a',
            'admin' => '1'
        ]);

        
        Supplier::insert([
            'nomFournisseur' => 'jean-mi',
            'adresseFournisseur' => 'petaoushnock',
            'categorieFournisseur' => 'nourriture'
        ]);


        Franchise::insert([
            'franchise' => '1'
        ]);

        
        Restaurant::insert([
            'nomRestaurant' => 'la bouffe',
            'adresseRestaurant' => 'adresse de la rue du resto',
            'numRestaurant' => 'numTest',
            'idFranchise' => 1
        ]);
    }
}
