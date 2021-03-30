<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->string('instructions');
            $table->decimal('total');
            $table->date('request_date');
            $table->date('delivery_date');
            $table->foreignId('restaurants_id')->constrained('restaurants');
            $table->foreignId('deliverer_id')->constrained('deliverers');
            $table->foreignId('orderable_id')->constrained('orderable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}