<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubgerenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subgerencia', function (Blueprint $table) {
            $table->bigIncrements('id_subgerencia');
            $table->string('nombre');
            $table->string('siglas');
            $table->integer('estado_subgerencia');
            $table->integer('nivel_jerarquico');
            $table->unsignedBigInteger('jefe_inmediato');
            $table->string('codigo_unico_creacion');
            $table->foreign('jefe_inmediato')->references('id_gerencia')->on('gerencia')->onDelete('cascade');
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
        Schema::dropIfExists('subgerencia');
    }
}
