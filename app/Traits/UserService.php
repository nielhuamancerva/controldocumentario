<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Personas;
use Illuminate\Support\Facades\DB;
trait UserService

{
    public function BuscarArea(){
        $inicioarea= Auth::user()->id;
        $id=User::findOrFail($inicioarea);
        $buscararea=$id->tieneArea();
        return $buscararea;
    }
    public function BuscarBarea(){
        $buscararea=$this->BuscarArea();
        foreach ($buscararea as $barea => $ids) {
        }
        return $barea;
    }
    public function BuscarAreaId(){
        $buscararea=$this->BuscarArea();
        foreach ($buscararea as $barea => $ids) {
        }
        return $ids;
    }
    public function BuscarNombreArea(){
        $inicioarea= Auth::user()->id;
        $id=User::findOrFail($inicioarea);
        $buscararea=$id->tieneAreas();
        foreach ($buscararea as $barea => $buscaranombrearea) {
        }
        return $buscaranombrearea;
    }
    public function BuscarPersona(){
        $persona= Auth::user()->persona_id;
        $persona =  DB::table('personas')
        ->select('name')
        ->where('id','=',$persona)
        ->first();
        return $persona->name;
    }
}
