<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_documentos', function (Blueprint $table) {
            $table->Bigincrements('id');
            $table->integer('expediente');
            $table->integer('NumeroDoc');
            $table->string('Siglas');
            $table->string('Asunto');
            $table->string('Año_Doc');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('documento_id');
            $table->unsignedBigInteger('nombre_cantidad_envio_id');
            $table->string('fase');
            $table->string('ClaseDocumento');
            $table->unsignedBigInteger('persona_id');
            $table->timestamps();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('documento_id')->references('id')->on('documentos')->onDelete('cascade');
            $table->foreign('nombre_cantidad_envio_id')->references('id_cantidad_envio')->on('cantidad_envio')->onDelete('cascade');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_documentos');
    }
}
