<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChooseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choose', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('idRestaurant')->constrained('restaurants');
            $table->foreignId('idClient')->constrained('customers');
            $table->primary(['idRestaurant', 'idClient']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choose');
    }
}
