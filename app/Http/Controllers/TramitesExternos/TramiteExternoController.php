<?php

namespace App\Http\Controllers\TramitesExternos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\TramitesInternos;
use App\Documentos;
use App\User;
use App\Areas;
use App\TramitesInternosEstadosDocumentos;
use App\requerimientos;
use Illuminate\Support\Facades\DB;
use App\Traits\UserService;
use App\Traits\DocumentoDetalleService;
use App\Traits\ExpedienteService;
use App\Traits\RemitentePersonaService;
class TramiteExternoController extends Controller
{
    use RemitentePersonaService;
    use UserService;
    use DocumentoDetalleService;
    use ExpedienteService;
    public function __construct()
    {
        $this->middleware('tramitador');
    }
    public function index()
    {
        $buscararea=$this->BuscarArea();
        $Listartramites = DB::table('detalles_documentos')
            ->join('documentos', 'detalles_documentos.documento_id', '=', 'documentos.id')
            ->join('areas', 'detalles_documentos.area_id', '=', 'areas.id')
            ->join('detalles_documentos_estado', 'detalles_documentos.id', '=', 'detalles_documentos_estado.detalles_documento_id')
            ->where([['detalles_documentos_estado.Areadestino','=',$buscararea],['detalles_documentos_estado.uso_documento','=','1'],['detalles_documentos_estado.estado_documento','=','enviado'],['documentos.clacificaciondocumento','=','externo']])
            ->select('detalles_documentos.*','areas.area','documentos.clacificaciondocumento','documentos.documento','detalles_documentos_estado.uso_documento','detalles_documentos_estado.detalles_documento_id')
            ->get();
        return view('tramitesexternos.tramiteexternobandeja',['Listartramites' => $Listartramites]);
    }

    public function create()
    {
        $buscararea=$this->BuscarArea();
        $Listarcantidadenvio=DB::table('cantidad_envio_area')
        ->join('cantidad_envio', 'cantidad_envio.id_cantidad_envio', '=', 'cantidad_envio_area.nombre_cantidad_envio_id')
        ->select('cantidad_envio_area.nombre_cantidad_envio_id','cantidad_envio.nombre_cantidad_envio')
        ->where('cantidad_envio_area.area_id','=',$buscararea)->get();
        
        $Listarenvio=DB::table('detalles_documentos_certifico_envio')->where('clase_envio_id','=','2')->get();
       
        $Listardocumentos=DB::table('acceso_envio_area')
        ->join('documentos','acceso_envio_area.documento_id','=','documentos.id')
        ->select('documentos.id','documentos.documento')
        ->where([['acceso_envio_area.area_id','=',$buscararea],['documentos.clacificaciondocumento','=','externo']])
        ->distinct()->get();

        $Listarareas =DB::table('acceso_envio_area')
        ->join('areas', 'acceso_envio_area.area_enviar', '=', 'areas.id')
        ->where('area_id','=',$buscararea)
        ->select('areas.id','areas.area')
        ->get();
        return view('tramitesexternos.tramiteexternodocumento',['Listardocumentos' =>$Listardocumentos,'Listarareas'=>$Listarareas,'Listarenvio'=>$Listarenvio,'Listarcantidadenvio'=>$Listarcantidadenvio]);
    }

    public function store(Request $request)
    {
        $buscararea=$this->BuscarArea();
        $newexpediente =  $this->BuscarExpediente();
  
        $ids=$this->BuscarAreaId();
        $barea=$this->BuscarBarea();
        $FirmaRemitenteInterno=$this->RemitenteExterno($request->dni,$request->nombres,$request->celular);
       
            $mensaje=$this->GuardarDocumentoDetalle($newexpediente+1,$request->numerodoc,$request->siglasareas,$request->asunto,$ids,$request->get('documentos'),$request->get('cantidad_areas')
            ,$ids,$request->get('areas'),$request->get('tipoenvio')
            ,0,0,1,$barea,'ENVIADO',2,'--',$FirmaRemitenteInterno);
            return redirect('/tramitesexternos')->with('expediente', $mensaje);
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
