<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesDocumentosEstadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_documentos_estado', function (Blueprint $table) {
            $table->Bigincrements('id');
            $table->integer('Areainicio');
            $table->integer('Areadestino');
            $table->integer('uso_documento');
            $table->string('estado_documento');
            $table->unsignedBigInteger('claseenvio_id');
            $table->unsignedBigInteger('tipoenvio_id');
            $table->string('nota');
            $table->unsignedBigInteger('detalles_documento_id');
            $table->integer('origen_detalles_documento_id');
            $table->integer('contador_detalles_documento_id');
            $table->integer('secuencia_detalles_documento_id');
            $table->foreign('claseenvio_id')->references('id_detalles_documentos_tipo_envio')->on('detalles_documentos_estado_tipo_envio')->onDelete('cascade');
            $table->foreign('tipoenvio_id')->references('id')->on('detalles_documentos_certifico_envio')->onDelete('cascade');
            $table->foreign('detalles_documento_id')->references('id')->on('detalles_documentos')->onDelete('cascade');
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
        Schema::dropIfExists('detalles_documentos_estado');
    }
}
