<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('area');
            $table->string('siglas');
            $table->integer('estado_area');
            $table->string('nivel_jerarquico');
            $table->string('codigo_unico_creacion');
            $table->string('jefe_inmediato');
            $table->string('codigo_jefe_inmediato');
            $table->string('matriz_gerencia');
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
        Schema::dropIfExists('areas');
    }
}
