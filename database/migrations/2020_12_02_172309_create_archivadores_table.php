<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivadores', function (Blueprint $table) {
            $table->bigIncrements('id_archivadores');
            $table->string('archivador');
            $table->string('estado_archivador');
            $table->string('tipo_archivador');
            $table->integer('codigo_archivador');
            $table->unsignedBigInteger('documento_id');
            $table->unsignedBigInteger('area_id');
            $table->timestamps();
            $table->foreign('documento_id')->references('id')->on('documentos')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivadores');
    }
}
