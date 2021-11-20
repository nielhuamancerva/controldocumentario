<?php

namespace App\Http\Controllers\AccesoEnvioAreas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\AccesoEnvioArea;
use App\User;
class AccesoEnvioAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('administrador');
    }
    public function index()
    {
        $ListarAccesoEnvio = DB::table('acceso_envio_area')
        ->join('areas', 'acceso_envio_area.area_id', '=', 'areas.id')
        ->join('areas as destino', 'acceso_envio_area.area_enviar', '=', 'destino.id')
        ->join('documentos','acceso_envio_area.documento_id','=','documentos.id')
        ->select('acceso_envio_area.*','documentos.documento','areas.area as area_origen','destino.area as destino')
        ->orderBy('acceso_envio_area.created_at', 'asc')
        ->get();

        $ListarDocumento=DB::table('documentos')
        ->get();

        return view('acceso_envio_areas.acceso_envio_area',['ListarAccesoEnvio' => $ListarAccesoEnvio,'ListarDocumento'=>$ListarDocumento]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $acceso_envio = new AccesoEnvioArea();
        $acceso_envio -> area_id = $request->get('acceso_envio_area');
        $acceso_envio -> area_enviar =  $request->get('area_enviar');
        $acceso_envio -> area_enviar =  $request->input('area_enviar');
       
        $acceso_envio -> nivel_jerarquico_area_enviar = $request->get('organigrama');
        $acceso_envio -> codigo_unico_creacion_area_enviar = $request->get('codigo_unico');
        $acceso_envio-> estado_acceso_envio = 1;
        $acceso_envio -> matriz_gerencia= $request->get('matriz_gerencia');
        $acceso_envio -> documento_id= $request->get('documento_enviar');
        $acceso_envio ->save();
        return redirect('/accesoenvioarea');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function acceso_envio_nivel(Request $request)
    {
        $acceso_envio = $request->get('accesoenvioarea');
      //  $acceso = $request->get('acces');
     
       //  if($acceso<>''){
            // $sub=DB::table('acceso_envio_area')
            // ->whereRaw("nivel_jerarquico_area_enviar='$acceso_envio' AND area_id='$acceso'")
           //  ->select('area_enviar');

           // $acce_envio_area = DB::table( DB::raw("({$sub->toSql()}) as en"))
           // ->select('can.id','can.area','can.codigo_unico_creacion','can.matriz_gerencia','can.nivel_jerarquico')
           // ->rightjoin('areas as can', 'can.id' , '=','en.area_enviar')
           // ->wherenull('en.area_enviar')
           // ->where('can.nivel_jerarquico','=',$acceso_envio)
           // ->get();

          //  $acce_envio_area = DB::table('areas')
          //  ->select('id','area','codigo_unico_creacion','matriz_gerencia')
          //  ->where([['nivel_jerarquico','=',$acceso_envio],['id','<>' ,$acceso]])
          //  ->get();

          //  return response()->json($acce_envio_area);
       //  }
            
         $acce_envio_area = DB::table('areas')
         ->select('id','area','codigo_unico_creacion')
         ->where('nivel_jerarquico','=',$acceso_envio)
         ->get();
         return response()->json($acce_envio_area);
       
    }
    public function acceso_envio_area(Request $request)
    {
        $acceso_envio = $request->get('accesoenvioarea');
        $acceso = $request->get('acces');
     
        $acce_envio_nivel = DB::table('areas')
        ->select('id','area')
        ->where([['nivel_jerarquico','=',$acceso_envio],['id','<>' ,$acceso]])
        ->get();

        return response()->json($acce_envio_nivel);
  
    }

    public function acceso_envio_destino(Request $request)
    {
        $acceso_destino = $request->get('accesodestino');
   
     
        $acceso_envio_destino = DB::table('areas')
        ->select('id','area','codigo_unico_creacion','matriz_gerencia')
        ->where('id','=',$acceso_destino)
        ->get();
        return response()->json($acceso_envio_destino);

    }

    public function acceso_envio_documento(Request $request)
    {
        $accesoareadestino = $request->get('accesodestino');
        $accesoareainicio = $request->get('acces');

 

           $sub=DB::table('acceso_envio_area')
             ->whereRaw("area_id='$accesoareainicio' AND area_enviar='$accesoareadestino'")
            ->select('documento_id');

            $accesoenviodocumento = DB::table( DB::raw("({$sub->toSql()}) as en"))
           ->select('can.id','can.documento')
            ->rightjoin('documentos as can', 'can.id' , '=','en.documento_id')
           ->wherenull('en.documento_id')
           ->get();

        return response()->json($accesoenviodocumento);
    }
   
}
