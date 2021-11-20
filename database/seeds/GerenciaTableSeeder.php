<?php

use Illuminate\Database\Seeder;

class GerenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gerencia')->insert([[
            'nombre' => 'Gerencia de Administracion y Finanzas',
            'siglas'     => 'GAF',
            'estado_gerencia'     => '1',
            'nivel_jerarquico'     => '2',
            'jefe_inmediato'    => '2',
            'codigo_unico_creacion'     => 'G1',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre' => 'Gerencia de Asesoria Juridica',
            'siglas'     => 'GAJ',
            'estado_gerencia'     => '1',
            'nivel_jerarquico'     => '2',
            'jefe_inmediato'    => '2',
            'codigo_unico_creacion'     => 'G2',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre' => 'Gerencia de Planeamiento Presupuesto y Programacion de la Inversiones',
            'siglas'     => 'GPPPI/MDP',
            'estado_gerencia'     => '1',
            'nivel_jerarquico'     => '2',
            'jefe_inmediato'    => '2',
            'codigo_unico_creacion'     => 'G3',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre' => 'Gerencia de Administracion Tributaria',
            'siglas'     => 'GAT/MDP',
            'estado_gerencia'     => '1',
            'nivel_jerarquico'     => '2',
            'jefe_inmediato'     => '2',
            'codigo_unico_creacion'     => 'G4',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre' => 'Gerencia de Infraestructura y Desarrollo Urbano y Rural',
            'siglas'     => 'GIDUR/MDP',
            'estado_gerencia'     => '1',
            'nivel_jerarquico'     => '2',
            'jefe_inmediato'     => '2',
            'codigo_unico_creacion'     => 'G5',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre' => 'Gerencia de Servicios Publicos y Del Ambiente',
            'siglas'     => 'GSPA/MDP',
            'estado_gerencia'     => '1',
            'nivel_jerarquico'     => '2',
            'jefe_inmediato'     => '2',
            'codigo_unico_creacion'     => 'G6',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre' => 'Gerencia de Desarrollo Economico',
            'siglas'     => 'GDE/MDP',
            'estado_gerencia'     => '1',
            'nivel_jerarquico'     => '2',
            'jefe_inmediato'    => '2',
            'codigo_unico_creacion'     => 'G7',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre' => 'Gerencia de Promocion Social y Desarrollo Humano',
            'siglas'     => 'GPSDH/MDP',
            'estado_gerencia'     => '1',
            'nivel_jerarquico'     => '2',
            'jefe_inmediato'     => '2',
            'codigo_unico_creacion'     => 'G8',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
            'nombre' => 'Gerencia de Seguridad Ciudadana',
            'siglas'     => 'GSC/MDP',
            'estado_gerencia'     => '1',
            'nivel_jerarquico'     => '2',
            'jefe_inmediato'    => '2',
            'codigo_unico_creacion'     => 'G9',
            'updated_at'=> "2017-11-24 15:55:32",
            'created_at'=> "2017-11-24 15:55:32",   
            ],[
                'nombre' => 'Secreatria General',
                'siglas'     => 'S.GRAL/MDP',
                'estado_gerencia'     => '1',
                'nivel_jerarquico'     => '2',
                'jefe_inmediato'     => '2',
                'codigo_unico_creacion'     => 'G10',
                'updated_at'=> "2017-11-24 15:55:32",
                'created_at'=> "2017-11-24 15:55:32",   
                ],[
                    'nombre' => 'Gerencia de Estudios y Proyectos de Inversion',
                    'siglas'     => 'GEPI/MDP',
                    'estado_gerencia'     => '1',
                    'nivel_jerarquico'     => '2',
                    'jefe_inmediato'    => '2',
                    'codigo_unico_creacion'     => 'G11',
                    'updated_at'=> "2017-11-24 15:55:32",
                    'created_at'=> "2017-11-24 15:55:32",   
                    ],[
                        'nombre' => 'Procurador',
                        'siglas'     => 'PPM/MDP',
                        'estado_gerencia'     => '1',
                        'nivel_jerarquico'     => '2',
                        'jefe_inmediato'    => '2',
                        'codigo_unico_creacion'     => 'G12',
                        'updated_at'=> "2017-11-24 15:55:32",
                        'created_at'=> "2017-11-24 15:55:32",   
                        ],[
                            'nombre' => 'Defensa Civil',
                            'siglas'     => 'ODCyCR/MDP',
                            'estado_gerencia'     => '1',
                            'nivel_jerarquico'     => '2',
                            'jefe_inmediato'    => '2',
                            'codigo_unico_creacion'     => 'G13',
                            'updated_at'=> "2017-11-24 15:55:32",
                            'created_at'=> "2017-11-24 15:55:32",   
                            ],[
                                'nombre' => 'Registro Civil',
                                'siglas'     => 'OREC/MDP',
                                'estado_gerencia'     => '1',
                                'nivel_jerarquico'     => '2',
                                'jefe_inmediato'    => '2',
                                'codigo_unico_creacion'     => 'G14',
                                'updated_at'=> "2017-11-24 15:55:32",
                                'created_at'=> "2017-11-24 15:55:32",   
                                ],[
                                    'nombre' => 'Gestion Municipal de Servicios de Saneamiento',
                                    'siglas'     => 'UGMSS-GM/MDP',
                                    'estado_gerencia'     => '1',
                                    'nivel_jerarquico'     => '2',
                                    'jefe_inmediato'    => '2',
                                    'codigo_unico_creacion'     => 'G15',
                                    'updated_at'=> "2017-11-24 15:55:32",
                                    'created_at'=> "2017-11-24 15:55:32",   
                                    ],[
                                        'nombre' => 'Policia Municipal',
                                        'siglas'     => 'UPM-MDP',
                                        'estado_gerencia'     => '1',
                                        'nivel_jerarquico'     => '2',
                                        'jefe_inmediato'    => '2',
                                        'codigo_unico_creacion'     => 'G16',
                                        'updated_at'=> "2017-11-24 15:55:32",
                                        'created_at'=> "2017-11-24 15:55:32",   
                                        ],[
                                            'nombre' => 'Oficina Tecnica Municipal de Saneamiento',
                                            'siglas'     => 'OTMS-GM-MDP',
                                            'estado_gerencia'     => '1',
                                            'nivel_jerarquico'     => '2',
                                            'jefe_inmediato'    => '2',
                                            'codigo_unico_creacion'     => 'G17',
                                            'updated_at'=> "2017-11-24 15:55:32",
                                            'created_at'=> "2017-11-24 15:55:32",   
                                            ]]);
    }
}
