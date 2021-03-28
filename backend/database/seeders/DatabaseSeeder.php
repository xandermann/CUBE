<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'email' => 'a@a.a',
            'password' => '$2y$10$VBhMtl0miG1TQqCm39Lrv.hpmr8OErTyEcoFyOILFv3VLDYDR/kwO',
            'name' => 'a', // TODO : change into "lastname"
            'firstname' => 'a',
            'country' => 'France',
            'city' => 'Nancy',
            'postcode' => 54000,
            'street' => 'a',
            'language' => 'fr'
        ]);
    }
}
