<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Personas;
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username','name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Roles::class)->withTimestamps();
    }
    public function asignarRol($roles){
        $this->roles()->sync($roles,false);
    }
    public function tieneRol(){
        return $this->roles->flatten()->pluck('name')->first();
    }
    
    public function areas(){
        return $this->belongsToMany(Areas::class)->withTimestamps();
    }
    public function asignarArea($area){
        $this->areas()->sync($area,false);
    }
    public function tieneArea(){
        return $this->areas->flatten()->pluck('id','matriz_gerencia')->unique();
    }
    public function tieneAreas(){
        return $this->areas->flatten()->pluck('area')->unique();
    }
    public function cargos(){
        return $this->belongsToMany(Cargos::class)->withTimestamps();
    }
    public function asignarCargo($cargo){
        $this->cargos()->sync($cargo,false);
    }
    public function tieneCargos(){
        return $this->cargos->flatten()->pluck('cargo')->unique();
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
