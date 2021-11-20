<?php

use Illuminate\Database\Seeder;

class detallesdocumentosestadotipoenvioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalles_documentos_estado_tipo_envio')->insert([[
            'clase_envio_documento' => 'Sello',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'clase_envio_documento' => 'Documento',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ]]);
    }
}
