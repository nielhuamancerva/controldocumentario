<?php

use Illuminate\Database\Seeder;

class DocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('documentos')->insert([[
            'documento'     => 'INFORME',
            'clacificaciondocumento'     => 'interno',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'MEMORANDO',
            'clacificaciondocumento'     => 'interno',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'RESOLUCION',
            'clacificaciondocumento'     => 'interno',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'ORDEN DE SERVICIO',
            'clacificaciondocumento'     => 'interno',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'ORDEN DE COMPRA',
            'clacificaciondocumento'     => 'interno',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'CARTA',
            'clacificaciondocumento'     => 'externo',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'OFICIO',
            'clacificaciondocumento'     => 'externo',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'SOLICITUD',
            'clacificaciondocumento'     => 'externo',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'MEMORANDO MULTIPLE',
            'clacificaciondocumento'     => 'internO',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'RESOLUSIÓN GERENCIAL',
            'clacificaciondocumento'     => 'interno',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ],[
            'documento'     => 'NOTAS INFORMATIVAS',
            'clacificaciondocumento'     => 'interno',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",
        ]]);
    }
}
