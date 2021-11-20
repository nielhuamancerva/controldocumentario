<?php

namespace App\Http\Controllers\Expediente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TramitesInternos;
use App\TramitesInternosEstadosDocumentos;
use App\Areas;
use App\Documentos;
use App\Estado_Documento;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ExpedienteController extends Controller
{
   
    public function index(Request $request)
    {
        $tipobusqueda = $request->get('tipobusqueda');

        $texto_buscar = trim($request->get('buscar'));
 
        if($tipobusqueda==null || $tipobusqueda=="expediente"){
            $tipobusqueda = 'expediente';
            $buscar='%'.$texto_buscar.'%';
            $signo='LIKE';
        }
        else
        {
            $buscar=$texto_buscar;
            $signo='=';
        }
            $ListarExpediente = DB::table('detalles_documentos')
            ->join('personas', 'detalles_documentos.persona_id', '=', 'personas.id')
            ->join('documentos', 'detalles_documentos.documento_id', '=', 'documentos.id')
            ->join('detalles_documentos_estado', 'detalles_documentos.id', '=', 'detalles_documentos_estado.detalles_documento_id')
            ->join('detalles_documentos_estado_tipo_envio', 'id_detalles_documentos_tipo_envio', '=', 'detalles_documentos_estado.claseenvio_id')
            ->join('areas', 'detalles_documentos_estado.Areainicio', '=', 'areas.id')
            ->join('areas as destino', 'detalles_documentos_estado.Areadestino', '=', 'destino.id')
            ->where($tipobusqueda,$signo,$buscar)
            ->select('detalles_documentos.*','areas.area','destino.area as destino','documentos.documento','detalles_documentos_estado.estado_documento','detalles_documentos_estado.Areainicio','detalles_documentos_estado.Areadestino','detalles_documentos_estado.nota','detalles_documentos_estado_tipo_envio.clase_envio_documento','personas.dni')
            ->orderBy('detalles_documentos_estado.created_at', 'asc')
            ->get();

        return view('Expediente.Expediente',['ListarExpediente' => $ListarExpediente,'buscar'=>$texto_buscar,'tipobusqueda'=>$tipobusqueda]);
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
}
