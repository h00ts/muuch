<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impacto', function (Blueprint $table) {
            $table->increments('id');
            $table->float('beneficiarios');
            $table->float('sistemas');
            $table->float('potencia');
            $table->float('energia');
            $table->float('co2');
            $table->unsignedInteger('equipo');
            $table->unsignedInteger('embajadores');
            $table->unsignedInteger('enlaces');
            $table->unsignedInteger('escuelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('impacto');
    }
}
