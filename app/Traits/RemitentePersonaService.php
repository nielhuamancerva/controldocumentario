<?php

namespace App\Traits;
use App\Traits\UserService;
use Illuminate\Support\Facades\DB;
use App\Personas;
trait RemitentePersonaService

{
    public function RemitenteInterno(){
        $AreaId=$this->BuscarAreaId();
        $Remitente =  DB::table('cargos_user')
        ->join('areas_user', 'cargos_user.user_id', '=', 'areas_user.user_id')
        ->join('cargos', 'cargos.id', '=', 'cargos_user.cargos_id')
        ->select('cargos_user.user_id')
        ->where([['areas_user.areas_id','=',$AreaId],['cargos.cargo','=','Jefe']])
        ->first();
        return $Remitente->user_id;
    }
    public function RemitenteExterno($dni,$nombres,$celular){
        $persona =  DB::table('personas')
        ->select('id')
        ->where('dni','=',$dni)
        ->first();
        if($persona==null)
        {
            $persona = new Personas;
            $persona->dni=$dni;
            $persona->name=$nombres;
            $persona->celular=$celular;
            $persona->tipo_persona='ciudadano';
            $persona->save();
        }

        return $persona->id;
    }
}
