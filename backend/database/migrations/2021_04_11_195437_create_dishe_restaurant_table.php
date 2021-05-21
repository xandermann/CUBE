<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisheRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishe_restaurant', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('dishe_id')->constrained('dishes')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreignId('restaurant_id')->constrained('restaurants')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishe_restaurant');
    }
}
