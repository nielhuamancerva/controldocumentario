<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();


Route::group(['middleware'=>'auth'],function(){
Route::resource('roles','Roles\RolController');
Route::resource('areas','Areas\AreaController');
Route::get('/niveljerarquico','Areas\AreaController@organigrama')->name('niveljerarquico');
Route::resource('usuarios','Usuarios\UserController');
Route::resource('personas','Personas\PersonaController');
Route::resource('documentos','Documentos\DocumentoController');
Route::resource('accesoenvioarea','AccesoEnvioAreas\AccesoEnvioAreaController');
Route::get('/acceso_envio_nivel','AccesoEnvioAreas\AccesoEnvioAreaController@acceso_envio_nivel')->name('acceso_envio_nivel');
Route::get('/acceso_envio_area','AccesoEnvioAreas\AccesoEnvioAreaController@acceso_envio_area')->name('acceso_envio_area');
Route::get('/acceso_envio_destino','AccesoEnvioAreas\AccesoEnvioAreaController@acceso_envio_destino')->name('acceso_envio_destino');
Route::get('/acceso_envio_documento','AccesoEnvioAreas\AccesoEnvioAreaController@acceso_envio_documento')->name('acceso_envio_documento');
Route::resource('cantidadenvioarea','CantidadEnvioAreas\CantidadEnvioAreaController');
Route::get('/cantidad_envio','CantidadEnvioAreas\CantidadEnvioAreaController@busqueda')->name('cantidad_envio');
Route::resource('archivadores','Archivadores\ArchivadorController');
Route::resource('tramitesinternos','TramiteInternos\TramiteInternoController');
Route::get('/tramites/recepcion/{id}','TramiteInternos\TramiteInternoController@recepcionado')->name('recepcionado');
Route::get('/AreaEnvio','TramiteInternos\TramiteInternoController@AreaEnvio')->name('AreaEnvio');
Route::get('/getnumero','TramiteInternos\TramiteInternoController@getnumeros')->name('getnumero');
Route::resource('tramitesinternosprocesos','TramiteInternos\TramiteInternoProcesosController');
Route::patch('/BandejaDocumentoProcesar/alterar/{id}','TramiteInternos\TramiteInternoController@ReenvioDocumentoProcesar')->name('ReenvioDocumentoProcesar.update');
Route::patch('/tramites/archivado/{id}','TramiteInternos\TramiteInternoController@ReenvioDocumentoArchivar')->name('archivado');
Route::resource('expediente','Expediente\ExpedienteController');
Route::resource('archivadoresenviados','Archivadores\ArchivadorEnviadoController');
Route::resource('archivadoresrecibidos','Archivadores\ArchivadorRecibidoController');
Route::patch('/archivadoresrecibidos/EnviarProveido/{id}','Archivadores\ArchivadorRecibidoController@EnviarProveidoArchivado')->name('EnviarProveidoArchivado');
Route::patch('/Archivadores/BandejaArchivados/{id}','Archivadores\ArchivadorController@ActivarArchivado')->name('ActivarArchivado');
Route::resource('tramitesexternos','TramitesExternos\TramiteExternoController');
Route::get('/home', 'HomeController@index')->name('home');
Route::patch('/home/cambiocontraseña{id}', 'HomeController@editar_password')->name('cambiocontraseña');
});

