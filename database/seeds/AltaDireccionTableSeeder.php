<?php

use Illuminate\Database\Seeder;

class AltaDireccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('altadireccion')->insert([[
            'nombre' => 'Alcaldia',
            'siglas'     => 'A',
            'estado_altadireccion'     => '1',
            'nivel_jerarquico'     => '1',
            'codigo_unico_creacion'     => 'AD1',
            'id_jefe_inmediato'     => 'ninguno',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre' => 'Gerencia Municipal',
            'siglas'     => 'GM',
            'estado_altadireccion'     => '1',
            'nivel_jerarquico'     => '1',
            'codigo_unico_creacion'     => 'AD2',
            'id_jefe_inmediato'     => 'ninguno',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ]]);
    }
}
