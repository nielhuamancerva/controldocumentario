<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCantidadEnvioAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cantidad_envio_area', function (Blueprint $table) {
            $table->bigIncrements('id_cantidad_envio_area');
            $table->integer('estado_cantidad_envio');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->unsignedBigInteger('nombre_cantidad_envio_id');
            $table->foreign('nombre_cantidad_envio_id')->references('id_cantidad_envio')->on('cantidad_envio')->onDelete('cascade');
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
        Schema::dropIfExists('cantidad_envio_area');
    }
}
