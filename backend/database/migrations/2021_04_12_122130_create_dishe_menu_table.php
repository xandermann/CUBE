<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisheMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishe_menu', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('dishe_id')->constrained('dishes')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreignId('menu_id')->constrained('menus')
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
        Schema::dropIfExists('dishe_menu');
    }
}
