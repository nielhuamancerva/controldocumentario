<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
trait DocumentoService

{
    public function TipoDocumento($documento_id){
        $expediente =  DB::table('detalles_documentos')->max('expediente');
        return $expediente;
    }

}
