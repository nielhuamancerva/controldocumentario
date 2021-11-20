<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesoEnvioAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acceso_envio_area', function (Blueprint $table) {
            $table->bigIncrements('id_acceso_envio');
            $table->unsignedBigInteger('area_id');
            $table->integer('area_enviar');
            $table->integer('nivel_jerarquico_area_enviar');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->string('codigo_unico_creacion_area_enviar');
            $table->integer('estado_acceso_envio');
            $table->string('matriz_gerencia');
            $table->unsignedBigInteger('documento_id');
            $table->foreign('documento_id')->references('id')->on('documentos')->onDelete('cascade');
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
        Schema::dropIfExists('acceso_envio_area');
    }
}
