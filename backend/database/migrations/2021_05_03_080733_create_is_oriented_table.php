<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsOrientedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('is_oriented', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('idRestaurant')->constrained('restaurants');
            $table->foreignId('idUtilisateur')->constrained('users');
            $table->primary(['idRestaurant', 'idUtilisateur']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('is_oriented');
    }
}
