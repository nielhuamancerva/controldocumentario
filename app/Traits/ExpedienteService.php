<?php

namespace App\Traits;
use Illuminate\Support\Facades\DB;
trait ExpedienteService

{
    public function BuscarExpediente(){
        $expediente =  DB::table('detalles_documentos')->max('expediente');
        return $expediente;
    }
    public function RebuscarExpediente($idexpediente)
    {
        $expediente = DB::table('detalles_documentos')->where('id','=',$idexpediente)->select('expediente')->first();
     
  
        return $expediente->expediente;
    }
}
