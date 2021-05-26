<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisheOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishe_order', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('quantity');
            $table->foreignId('dishe_id')->constrained('dishes')
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
        Schema::dropIfExists('dishe_order');
    }
}
