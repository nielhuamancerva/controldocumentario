<?php

namespace App\Http\Controllers\CantidadEnvioAreas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Areas;
use App\CantidadEnvio;
use App\CantidadEnvioArea;
use Illuminate\Support\Facades\DB;
class CantidadEnvioAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('administrador');
    }
    public function index()
    {
        $Listar_Cantidad_Envio_Area = DB::table('cantidad_envio_area')
        ->select('cantidad_envio_area.*','cantidad_envio.nombre_cantidad_envio','areas.area')
        ->join('cantidad_envio', 'nombre_cantidad_envio_id', '=', 'cantidad_envio.id_cantidad_envio')
        ->join('areas', 'id', '=', 'cantidad_envio_area.area_id')
        ->get();
       /*dd($Listar_Cantidad_Envio_Area);*/
        $ListarAreas = Areas::all(); 
        $ListarCantidadEnvio = CantidadEnvio::All();

        return view('cantidad_envio_areas.cantidad_envio_area',['Listar_Cantidad_Envio_Area' => $Listar_Cantidad_Envio_Area,'ListarAreas'=>$ListarAreas,'ListarCantidadEnvio'=>$ListarCantidadEnvio]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $nuevoarea = new CantidadEnvioArea();
        
        $nuevoarea -> estado_cantidad_envio = 1;
        $nuevoarea -> area_id = $request->get('cantidad_envio');
        $nuevoarea -> nombre_cantidad_envio_id = $request->get('area_cantidad_envio');
        $nuevoarea ->save();
        return redirect('/cantidadenvioarea');
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
    public function busqueda(Request $request)
    {
       $busqueda=$request->get('cantidad_envio_area');
       $sub=DB::table('cantidad_envio_area')->select('nombre_cantidad_envio_id')->whereRaw("area_id='$busqueda'");
       $cantidad_envio = DB::table( DB::raw("({$sub->toSql()}) as en")  )
       ->select('can.id_cantidad_envio','can.nombre_cantidad_envio')
       ->rightjoin('cantidad_envio as can', 'can.id_cantidad_envio' , '=','en.nombre_cantidad_envio_id')
       ->whereNull('en.nombre_cantidad_envio_id')
       ->get();
      
        return response()->json($cantidad_envio);
       
    }
}
