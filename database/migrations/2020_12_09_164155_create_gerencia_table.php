<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGerenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gerencia', function (Blueprint $table) {
            $table->bigIncrements('id_gerencia');
            $table->string('nombre');
            $table->string('siglas');
            $table->integer('estado_gerencia');
            $table->integer('nivel_jerarquico');
            $table->unsignedBigInteger('jefe_inmediato');
            $table->string('codigo_unico_creacion');
            $table->foreign('jefe_inmediato')->references('id_altadireccion')->on('altadireccion')->onDelete('cascade');
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
        Schema::dropIfExists('gerencia');
    }
}
