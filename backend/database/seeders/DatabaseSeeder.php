<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Supplier;
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
            'admin' => true
        ]);

        
        Supplier::insert([
            'nomFournisseur' => 'jean-mi',
            'adresseFournisseur' => 'petaoushnock',
            'categorieFournisseur' => 'nourriture'
        ]);

        
        Restaurant::insert([
            'nomRestaurant' => 'la bouffe',
            'adresseRestaurant' => 'adresse de la rue du resto',
            'numRestaurant' => 'numTest',
            'idFranchise' => Supplier::where('nomFournisseur', 'jean-mi')->first()->value('id')
        ]);
    }
}
