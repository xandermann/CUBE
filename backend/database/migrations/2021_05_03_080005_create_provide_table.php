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
            $table->foreignId('idIngredient')->constrained('ingredients');
            $table->foreignId('idFournisseur')->constrained('suppliers');
            $table->primary(['idIngredient', 'idFournisseur']);
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
