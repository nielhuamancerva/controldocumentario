<?php

use Illuminate\Database\Seeder;

class OficinaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oficina')->insert([[
            'nombre' => 'Almacen',
            'siglas'     => 'Al',
            'estado_oficina'     => '1',
            'nivel_jerarquico'     => '4',
            'jefe_inmediato'    => '2',
            'codigo_unico_creacion'     => 'O1',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
        ],[
                'nombre' => 'Caja',
                'siglas'     => 'C',
                'estado_oficina'     => '1',
                'nivel_jerarquico'     => '4',
                'jefe_inmediato'    => '3',
                'codigo_unico_creacion'     => 'O2',
                'updated_at'=> "2017-11-24 15:55:32",
                'created_at'=> "2017-11-24 15:55:32",   
        ],[
            'nombre' => 'Tramite',
            'siglas'     => 'TD/MDP',
            'estado_oficina'     => '1',
            'nivel_jerarquico'     => '4',
            'jefe_inmediato'    => '3',
            'codigo_unico_creacion'     => 'O3',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
        ],[
            'nombre' => 'Unidad Supervision y Control Sanitario',
            'siglas'     => 'USCS/MDP',
            'estado_oficina'     => '1',
            'nivel_jerarquico'     => '4',
            'jefe_inmediato'    => '21',
            'codigo_unico_creacion'     => 'O4',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
        ],[
            'nombre' => 'Unidad Local de Evaluacion y Fiscalizacion Ambiental',
            'siglas'     => 'ULEFA/MDP',
            'estado_oficina'     => '1',
            'nivel_jerarquico'     => '4',
            'jefe_inmediato'    => '21',
            'codigo_unico_creacion'     => 'O5',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
        ]]);
    }
}
