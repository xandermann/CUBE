<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsComposedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('is_composed', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('dishe_id')->constrained('dishes');
            $table->foreignId('ingredient_id')->constrained('ingredients');
            $table->primary(['dishe_id', 'ingredient_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('is_composed');
    }
}
