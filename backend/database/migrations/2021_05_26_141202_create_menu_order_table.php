<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_order', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('quantity');
            $table->foreignId('menu_id')->constrained('menus')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreignId('order_id')->constrained('orders')
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
        Schema::dropIfExists('menu_order');
    }
}
