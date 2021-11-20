<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesDocumentosCertificoEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_documentos_certifico_envio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_envio');
            $table->unsignedBigInteger('clase_envio_id');
            $table->foreign('clase_envio_id')->references('id_detalles_documentos_tipo_envio')->on('detalles_documentos_estado_tipo_envio')->onDelete('cascade');
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
        Schema::dropIfExists('detalles_documentos_certifico_envio');
    }
}
