<?php

namespace App\Http\Controllers\Areas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Areas;
use Illuminate\Support\Facades\DB;
class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('administrador');
    }
    public function index()
    {
        $Listarareas = Areas::all();
        $ListarGerencias = DB::table('gerencia')
        ->select('id_gerencia','nombre')
        ->get();
        return view('areas.areas',['Listarareas' => $Listarareas,'ListarGerencias' => $ListarGerencias]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $nuevoarea = new Areas();
        $nuevoarea -> area = $request->get('organigrama');
        $nuevoarea -> siglas = $request->siglasarea;
        $nuevoarea -> estado_area = 1;
        $nuevoarea -> nivel_jerarquico = $request->get('niveljerarquico');
        $nuevoarea -> codigo_unico_creacion = $request->codigo_unico;
        $nuevoarea -> jefe_inmediato = $request->jefe_inmediato;
        $nuevoarea -> codigo_jefe_inmediato = $request->codigo_jefe_inmediato;
        $nuevoarea -> matriz_gerencia = $request->get('matriz_gerencia');
        $nuevoarea ->save();
        return redirect('/areas');
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
    public function organigrama(Request $request)
    {
        $organigrama = $request->get('niveljerarquico');
        $nivel='';
        switch($organigrama)
        {
            case "1":
                $nivel='altadireccion';
                $jefe='jefe_inmediato';
            break;
            case "2":
                $nivel='gerencia';
                $jefe='altadireccion';
            break;
            case "3":
                $nivel='subgerencia';
                $jefe='gerencia';
            break;
            case "4":   
                $nivel='oficina';
                $jefe='subgerencia';
            break;
        }
        if($organigrama==1){
            $sub = DB::table($nivel)
            ->select($nivel.'.nombre',$nivel.'.siglas',$nivel.'.nivel_jerarquico',$nivel.'.codigo_unico_creacion','id_jefe_inmediato as jefe_nombre','id_jefe_inmediato as codigo_jefe_nombre');
        }
        
        else{
            $sub=DB::table($nivel)
            ->select($nivel.'.nombre',$nivel.'.siglas',$nivel.'.nivel_jerarquico',$nivel.'.codigo_unico_creacion',$jefe.'.nombre as jefe_nombre',$jefe.'.codigo_unico_creacion as codigo_jefe_nombre')
            ->join($jefe,$nivel.'.jefe_inmediato', '=', $jefe.'.id_'.$jefe);
        }
       
        $nivelorganigrama = DB::table( DB::raw("({$sub->toSql()}) as en")  )
        ->select('en.nombre','en.siglas','en.nivel_jerarquico','en.codigo_unico_creacion','en.nombre as jefe_nombre','en.codigo_unico_creacion as codigo_jefe_nombre')
        ->leftjoin('areas as can', 'can.area' , '=','en.nombre')
        ->whereNull('can.area')
        ->get();
        return response()->json($nivelorganigrama);
    }
   
}
