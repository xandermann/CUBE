<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanBeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('can_be', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('idRestaurant')->constrained('restaurants');
            $table->foreignId('idGroupement')->constrained('groups');
            $table->primary(['idRestaurant', 'idGroupement']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('can_be');
    }
}
