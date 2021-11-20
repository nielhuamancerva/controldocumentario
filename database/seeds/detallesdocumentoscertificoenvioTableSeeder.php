<?php

use Illuminate\Database\Seeder;

class detallesdocumentoscertificoenvioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalles_documentos_certifico_envio')->insert([[
            'nombre_envio' => 'POSTFIRMA',
            'clase_envio_id' => '2',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'nombre_envio' => 'PROVEIDO',
            'clase_envio_id' => '1',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'nombre_envio' => 'SELLO RECEPCIÓN',
            'clase_envio_id' => '1',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'nombre_envio' => 'VISTO BUENO',
            'clase_envio_id' => '1',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'nombre_envio' => 'SELLO DE ARCHIVADO',
            'clase_envio_id' => '1',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ]]);

    }
}
