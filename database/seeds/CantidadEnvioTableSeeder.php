<?php

use Illuminate\Database\Seeder;

class CantidadEnvioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cantidad_envio')->insert([[
            'nombre_cantidad_envio' => 'Individual',
            'nivel_jerarquico' => '1',
            'estado_nombre_cantidad_envio'     => '1',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre_cantidad_envio' => 'A Todos Mis SubGerentes',
            'estado_nombre_cantidad_envio'     => '1',
            'nivel_jerarquico' => '3',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre_cantidad_envio' => 'A Todos los SubGerentes',
            'estado_nombre_cantidad_envio'     => '1',
            'nivel_jerarquico' => '3',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",     
            ],[
            'nombre_cantidad_envio' => 'A Todos los Gerentes',
            'estado_nombre_cantidad_envio'     => '1',
            'nivel_jerarquico' => '2',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",     
            ],[
            'nombre_cantidad_envio' => 'A Todas Mis Areas',
            'estado_nombre_cantidad_envio'     => '1',
            'nivel_jerarquico' => '5',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",     
            ],[
            'nombre_cantidad_envio' => 'A Todos',
            'estado_nombre_cantidad_envio'     => '1',
            'nivel_jerarquico' => '0',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",     
            ],[
            'nombre_cantidad_envio' => 'A Todos Mis Oficinas',
            'estado_nombre_cantidad_envio'     => '1',
            'nivel_jerarquico' => '4',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",     
            ],[
            'nombre_cantidad_envio' => 'A Todos las Oficinas ',
            'estado_nombre_cantidad_envio'     => '1',
            'nivel_jerarquico' => '4',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",     
            ],[
            'nombre_cantidad_envio' => 'Individual Y Jefe ',
            'estado_nombre_cantidad_envio'     => '1',
            'nivel_jerarquico' => '9',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",     
            ],[
                'nombre_cantidad_envio' => 'Especial',
                'estado_nombre_cantidad_envio'     => '1',
                'nivel_jerarquico' => '10',
                'updated_at'=> "2017-11-24 15:55:32",
                'created_at'=> "2017-11-24 15:55:32",     
                ]]);
    }
}
