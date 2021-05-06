<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provide', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('quantity');
            $table->foreignId('ingredient_id')->constrained('ingredients');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->primary(['ingredient_id', 'supplier_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provide');
    }
}
