<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesDocumentosEstadoTipoEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_documentos_estado_tipo_envio', function (Blueprint $table) {
            $table->bigIncrements('id_detalles_documentos_tipo_envio');
            $table->string('clase_envio_documento');
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
        Schema::dropIfExists('detalles_documentos_estado_tipo_envio');
    }
}
