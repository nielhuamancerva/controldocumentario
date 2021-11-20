<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCantidadEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cantidad_envio', function (Blueprint $table) {
            $table->bigIncrements('id_cantidad_envio');
            $table->string('nombre_cantidad_envio');
            $table->integer('estado_nombre_cantidad_envio');
            $table->integer('nivel_jerarquico');
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
        Schema::dropIfExists('cantidad_envio');
    }
}
