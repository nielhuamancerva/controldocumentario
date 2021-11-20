<?php

namespace App\Traits;
use App\Traits\UserService;
use App\TramitesInternos;
use App\TramitesInternosEstadosDocumentos;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
trait DocumentoDetalleService
{

    public function GuardarDocumentoDetalle($exp,$NumeroDocumento,$c,$d,$ids,$documento_id,$nombre_cantidad_envio_id,$Areainicio,$Areadestino,$tipoenvio_id
    ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,$barea,$estado_documento,$claseenvio_id,$nota,$Firma)
    {

        $now=Carbon::now();
        $nuevodocumento = new TramitesInternos();
        $nuevodocumento->expediente = $exp;
        $nuevodocumento->NumeroDoc = $this->ValidarNumeroDoc($NumeroDocumento,$documento_id);
        $nuevodocumento->Siglas = $c;
        $nuevodocumento->Asunto = $d;
        $nuevodocumento->Año_Doc =$now->year;
        $nuevodocumento->area_id = $ids;
        $nuevodocumento->documento_id = $documento_id;
        $nuevodocumento->nombre_cantidad_envio_id =$nombre_cantidad_envio_id;
        $nuevodocumento->fase = 'A';
        $nuevodocumento->ClaseDocumento =$this->TipoDocumento($documento_id);
        $nuevodocumento->persona_id = $Firma;
     
        if($nuevodocumento->save())
        {
      
            switch($nombre_cantidad_envio_id)
            {
            case "1":
                $this->CantidadEnvioIndividual($Areadestino,$ids,$tipoenvio_id,$nuevodocumento->id
                ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
                $estado_documento,$claseenvio_id,$nota);
            break;
            case "2":
                $this->ATodosMisSubGerentes($nombre_cantidad_envio_id,$ids,$barea,$tipoenvio_id,$nuevodocumento->id
                ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
                $estado_documento,$claseenvio_id,$nota);
            break;
            case "3":
                $this->ATodosLosSubGerentes($nombre_cantidad_envio_id,$ids,$tipoenvio_id,$nuevodocumento->id
                ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
                $estado_documento,$claseenvio_id,$nota);
            break;
            case "4": 
                $this->ATodosLosGerentes($nombre_cantidad_envio_id,$ids,$tipoenvio_id,$nuevodocumento->id
                ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
                $estado_documento,$claseenvio_id,$nota);
            break;
            case "5":   
                $this->ATodosMisAreas($ids,$barea,$tipoenvio_id,$nuevodocumento->id
                ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
                $estado_documento,$claseenvio_id,$nota);
            break;
            case "6":   
                $this->ATodos($ids,$tipoenvio_id,$nuevodocumento->id
                ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
                $estado_documento,$claseenvio_id,$nota);
            break;
            case "7":
                $this->AtodosMisOficinas($nombre_cantidad_envio_id,$ids,$barea,$tipoenvio_id,$nuevodocumento->id
                ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
                $estado_documento,$claseenvio_id,$nota);
            break;
            case "8":   
                $this->ATodosLasOficinas($nombre_cantidad_envio_id,$ids,$barea,$tipoenvio_id,$nuevodocumento->id
                ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
                $estado_documento,$claseenvio_id,$nota);
            break;
            case "9":   
                $this->IndividualYJefe($Areadestino,$ids,$tipoenvio_id,$nuevodocumento->id
                ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
                $estado_documento,$claseenvio_id,$nota);
            break; 
            case "10":   
                $this->CantidadEnvioEspecial($Areadestino,$ids,$barea,$tipoenvio_id,$nuevodocumento->id
                ,$origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
                $estado_documento,$claseenvio_id,$nota);
            break;
            }
            return $nuevodocumento->expediente;
        }
     
    }
    private function CantidadEnvioEspecial($AreadestinoArray,$ids,$barea,$tipoenvio_id,$detalles_documento_id,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
    $estado_documento,$claseenvio_id,$nota)
    {
                foreach ($AreadestinoArray as $envio => $Areadestino)
                {
                    $contador_detalles_documento_id=$envio+1;
                    $this->Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
                    $estado_documento,$claseenvio_id,$nota,
                    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id);
                }
    }
    private function IndividualYJefe($Areadestino,$ids,$tipoenvio_id,$detalles_documento_id,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
    $estado_documento,$claseenvio_id,$nota)
    {
                $buscararea=$this->BuscarArea();
                $sub=DB::table('areas')->select('jefe_inmediato')->whereRaw("id='$Areadestino'");
    
                $acce_envio_area = DB::table( DB::raw("({$sub->toSql()}) as en")  )
                ->select('can.id')
                ->join('areas as can', 'can.area' , '=','en.jefe_inmediato')
                ->first();
              
                $envio_masivo=DB::table('acceso_envio_area')
                ->select('area_enviar')
                ->where([['acceso_envio_area.area_id','=',$buscararea],['acceso_envio_area.area_enviar','=',$Areadestino]])
                ->orWhere([['acceso_envio_area.area_id','=',$buscararea],['acceso_envio_area.area_enviar','=',$acce_envio_area->id]])
                ->get();
             
        foreach ($envio_masivo as $envio => $Areadestino)
        {
            $contador_detalles_documento_id=$envio+1;
            $Areadestino=$Areadestino->area_enviar;
            $this->Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
            $estado_documento,$claseenvio_id,$nota,
            $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id);
        }
    }
    private function AtodosLasOficinas($nombre_cantidad_envio_id,$ids,$barea,$tipoenvio_id,$detalles_documento_id,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
    $estado_documento,$claseenvio_id,$nota)
    {
     $query_area=DB::table('cantidad_envio')
     ->where('id_cantidad_envio','=',$nombre_cantidad_envio_id)
     ->select('nivel_jerarquico')
     ->first();
     foreach ($query_area as $query => $area) {
     }
     $envio_masivo=DB::table('acceso_envio_area')
     ->select('area_enviar')
     ->where([['area_id','=',$ids],['nivel_jerarquico_area_enviar','=',$area],['matriz_gerencia','=',$barea]])->get();
     foreach ($envio_masivo as $envio => $Areadestino)
        {
            $contador_detalles_documento_id=$envio+1;
            $Areadestino=$Areadestino->area_enviar;
            $this->Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
            $estado_documento,$claseenvio_id,$nota,
            $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id);
        }
    }
    private function AtodosMisOficinas($nombre_cantidad_envio_id,$ids,$barea,$tipoenvio_id,$detalles_documento_id,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
    $estado_documento,$claseenvio_id,$nota)
    {
        $query_area=DB::table('cantidad_envio')
        ->where('id_cantidad_envio','=',$nombre_cantidad_envio_id)
        ->select('nivel_jerarquico')
        ->first();
        foreach ($query_area as $query => $area) {
        }
        $envio_masivo=DB::table('acceso_envio_area')
        ->select('area_enviar')
        ->where([['area_id','=',$ids],['nivel_jerarquico_area_enviar','=',$area],['matriz_gerencia','=',$barea]])->get();
        foreach ($envio_masivo as $envio => $Areadestino)
        {
            $contador_detalles_documento_id=$envio+1;
            $Areadestino=$Areadestino->area_enviar;
            $this->Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
            $estado_documento,$claseenvio_id,$nota,
            $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id);
        }
    }
    private function ATodos($ids,$tipoenvio_id,$detalles_documento_id,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
    $estado_documento,$claseenvio_id,$nota)
    {
        $envio_masivo=DB::table('acceso_envio_area')
        ->select('area_enviar')
        ->where('area_id','=',$ids)->get();
        foreach ($envio_masivo as $envio => $Areadestino)
        {
            $contador_detalles_documento_id=$envio+1;
            $Areadestino=$Areadestino->area_enviar;
            $this->Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
            $estado_documento,$claseenvio_id,$nota,
            $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id);
        }
    }
    private function ATodosMisAreas($ids,$barea,$tipoenvio_id,$detalles_documento_id,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
    $estado_documento,$claseenvio_id,$nota)
    {
        $envio_masivo=DB::table('acceso_envio_area')
        ->select('area_enviar')
        ->where([['area_id','=',$ids],['matriz_gerencia','=',$barea]])->get();
        foreach ($envio_masivo as $envio => $Areadestino)
        {
            $contador_detalles_documento_id=$envio+1;
            $Areadestino=$Areadestino->area_enviar;
            $this->Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
            $estado_documento,$claseenvio_id,$nota,
            $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id);
        }
    }
    private function ATodosLosGerentes($nombre_cantidad_envio_id,$ids,$tipoenvio_id,$detalles_documento_id,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
    $estado_documento,$claseenvio_id,$nota){
        $query_area=DB::table('cantidad_envio')
        ->where('id_cantidad_envio','=',$nombre_cantidad_envio_id)
        ->select('nivel_jerarquico')
        ->first();
        foreach ($query_area as $query => $area) {
        }
        $envio_masivo=DB::table('acceso_envio_area')
        ->select('area_enviar')
        ->where([['area_id','=',$ids],['nivel_jerarquico_area_enviar','=',$area]])->get();
        foreach ($envio_masivo as $envio => $Areadestino)
        {
            $contador_detalles_documento_id=$envio+1;
            $Areadestino=$Areadestino->area_enviar;
            $this->Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
            $estado_documento,$claseenvio_id,$nota,
            $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id);
        }
    } 
    private function ATodosLosSubGerentes($nombre_cantidad_envio_id,$ids,$tipoenvio_id,$detalles_documento_id,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
    $estado_documento,$claseenvio_id,$nota){
    $query_area=DB::table('cantidad_envio')
    ->where('id_cantidad_envio','=',$nombre_cantidad_envio_id)
    ->select('nivel_jerarquico')
    ->first();
    foreach ($query_area as $query => $area) {
    }
    $envio_masivo=DB::table('acceso_envio_area')
    ->select('area_enviar')
    ->where([['area_id','=',$ids],['nivel_jerarquico_area_enviar','=',$area]])->get();
    foreach ($envio_masivo as $envio =>$Areadestino)
    {
        $contador_detalles_documento_id=$envio+1;
        $Areadestino=$Areadestino->area_enviar;
        $this->Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
        $estado_documento,$claseenvio_id,$nota,
        $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id);
    }
}
    private function ATodosMisSubGerentes($nombre_cantidad_envio_id,$ids,$barea,$tipoenvio_id,$detalles_documento_id,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
    $estado_documento,$claseenvio_id,$nota){
        $query_area=DB::table('cantidad_envio')
        ->where('id_cantidad_envio','=',$nombre_cantidad_envio_id)
        ->select('nivel_jerarquico')
        ->first();
        foreach ($query_area as $query => $area) {
        }
        $envio_masivo=DB::table('acceso_envio_area')
        ->select('area_enviar')
        ->where([['area_id','=',$ids],['nivel_jerarquico_area_enviar','=',$area],['matriz_gerencia','=',$barea]])->get();
        foreach ($envio_masivo as $envio => $Areadestino)
        {
            $contador_detalles_documento_id=$envio+1;
            $Areadestino=$Areadestino->area_enviar;
            $this->Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
            $estado_documento,$claseenvio_id,$nota,
            $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id);
        }
    }
    private function CantidadEnvioIndividual($Areadestino,$ids,$tipoenvio_id,$detalles_documento_id,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id,
    $estado_documento,$claseenvio_id,$nota)
    {
                $contador_detalles_documento_id=1;
                $this->Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
                $estado_documento,$claseenvio_id,$nota,
                $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id);
                
    }
    private function Guardar_Estado_Documento($ids,$tipoenvio_id,$detalles_documento_id,$Areadestino,
    $estado_documento,$claseenvio_id,$nota,
    $origen_detalles_documento_id,$contador_detalles_documento_id,$secuencia_detalles_documento_id)
    {
            $nuevoestado = new TramitesInternosEstadosDocumentos();
            $nuevoestado -> Areainicio =  $ids;
            $nuevoestado -> Areadestino = $Areadestino;
            $nuevoestado -> estado_documento = $estado_documento;
            $nuevoestado -> uso_documento = 1;
            $nuevoestado -> tipoenvio_id = $tipoenvio_id;
            $nuevoestado -> claseenvio_id =$claseenvio_id;
            $nuevoestado -> nota = $nota;
            $nuevoestado -> detalles_documento_id= $detalles_documento_id;
            $nuevoestado -> origen_detalles_documento_id=$origen_detalles_documento_id;
            $nuevoestado -> contador_detalles_documento_id = $contador_detalles_documento_id;
            $nuevoestado -> secuencia_detalles_documento_id =$secuencia_detalles_documento_id;
            $nuevoestado->save();
    }
    private function ValidarNumeroDoc($NumeroDocumento,$documento_id)
    {
        $verificacion=$this->BuscarNombreArea();
    
     if($verificacion == 'Tramite')
     {
        $numerodocumento=0;
     }
     else{
        $buscararea=$this->BuscarArea();
        $numerodocumento =  DB::table('detalles_documentos')->where([['area_id','=',$buscararea],['documento_id','=',$documento_id]])->orderBy('created_at', 'desc')->max('NumeroDoc');
     }
    
     if($NumeroDocumento == $numerodocumento+1){
         $NumeroDocumento = $NumeroDocumento;
     }
     elseif($numerodocumento == 0)
     {
         $NumeroDocumento = $NumeroDocumento;
     }
     else{
         $NumeroDocumento= $numerodocumento+1;
         }
     return $NumeroDocumento;
    }
    public function TipoDocumento($documento_id){
        $tipodocumento =  DB::table('documentos')
        ->where('id','=',$documento_id)
        ->select('clacificaciondocumento')
        ->first();
        return $tipodocumento->clacificaciondocumento;
    }
    
}
