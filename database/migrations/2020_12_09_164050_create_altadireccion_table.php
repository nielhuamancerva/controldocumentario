<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAltadireccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('altadireccion', function (Blueprint $table) {
            $table->bigIncrements('id_altadireccion');
            $table->string('nombre');
            $table->string('siglas');
            $table->integer('estado_altadireccion');
            $table->integer('nivel_jerarquico');
            $table->string('codigo_unico_creacion');
            $table->string('id_jefe_inmediato');
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
        Schema::dropIfExists('altadireccion');
    }
}
