<?php

namespace App\Http\Controllers\TramiteInternos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\TramitesInternos;
use App\Documentos;
use App\User;
use App\Areas;
use App\AccesoEnvio;
use App\TramitesInternosEstadosDocumentos;
use App\Envio;
use App\requerimientos;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use App\Traits\UserService;
use App\Traits\DocumentoDetalleService;
class TramiteInternoProcesosController extends Controller
{
    use UserService;
    use DocumentoDetalleService;
    public function __construct()
    {
        $this->middleware('empleado');
    }
    public function index()
    {
        $inicioarea= Auth::user()->id;
        $id=User::find($inicioarea);
        $buscararea=$id->tieneArea('id');
        $Listarenvio= DB::table('detalles_documentos_certifico_envio')->where('clase_envio_id','=','2')->get();
    

        $Listardocumentos=DB::table('acceso_envio_area')
        ->join('documentos','acceso_envio_area.documento_id','=','documentos.id')
        ->select('documentos.id','documentos.documento')
        ->where([['acceso_envio_area.area_id','=',$buscararea],['documentos.clacificaciondocumento','=','interno']])
        ->distinct()->get();

        $Listarareas =DB::table('acceso_envio_area')
        ->join('areas', 'acceso_envio_area.area_enviar', '=', 'areas.id')
        ->where('area_id','=',$buscararea)
        ->select('areas.id','areas.area')
        ->distinct()->get();

        $Listartramites = DB::table('detalles_documentos')
            ->join('documentos', 'detalles_documentos.documento_id', '=', 'documentos.id')
            ->join('areas', 'detalles_documentos.area_id', '=', 'areas.id')
            ->join('detalles_documentos_estado', 'detalles_documentos.id', '=', 'detalles_documentos_estado.detalles_documento_id')
            ->where([['detalles_documentos_estado.Areadestino','=',$buscararea],['detalles_documentos_estado.uso_documento','=','1'],['detalles_documentos_estado.estado_documento','=','aceptado']])
            ->select('detalles_documentos.*','areas.area','documentos.documento','detalles_documentos_estado.uso_documento','detalles_documentos_estado.detalles_documento_id')
            ->get();

        $Listarcantidadenvio=DB::table('cantidad_envio_area')
            ->join('cantidad_envio', 'cantidad_envio.id_cantidad_envio', '=', 'cantidad_envio_area.nombre_cantidad_envio_id')
            ->select('cantidad_envio_area.nombre_cantidad_envio_id','cantidad_envio.nombre_cantidad_envio')
            ->where('area_id','=',$buscararea)->get();
        return view('tramitesinternos.tramiteinternoprocesos',['Listartramites' => $Listartramites,'Listarareas'=>$Listarareas,'Listarenvio'=>$Listarenvio,'Listardocumentos'=>$Listardocumentos,'Listarcantidadenvio'=>$Listarcantidadenvio]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
         $tramite= TramitesInternosEstadosDocumentos::where([['detalles_documento_id','=',$id],['uso_documento','=',1],['estado_documento','=','aceptado']])->first();
        $tramite->uso_documento=0;
        if($tramite->save()){
    
            $mensaje=$this->Guardar_Estado_Documento($tramite->Areadestino,$request->get('tipoenvio'),$tramite->detalles_documento_id,$request->get('areas'),
            'ENVIADO',1,$request->nota,$tramite->origen_detalles_documento_id,$tramite->contador_detalles_documento_id,$tramite->secuencia_detalles_documento_id);
            return redirect ('/tramitesinternosprocesos')->with('reenvioexpediente', $tramite->expediente);
        }
    
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
        
        $tramite= TramitesInternosEstadosDocumentos::where([['detalles_documento_id','=',$id],['uso_documento','=',1],['estado_documento','=','aceptado']])->first();
        $tramite->uso_documento=0;
        if($tramite->save()){
    
            $mensaje=$this->Guardar_Estado_Documento($tramite->Areadestino,$request->get('tipoenvio'),$tramite->detalles_documento_id,$request->get('areas'),
            'ENVIADO',1,$request->nota,$tramite->origen_detalles_documento_id,$tramite->contador_detalles_documento_id,$tramite->secuencia_detalles_documento_id);
            return redirect ('/tramitesinternosprocesos')->with('reenvioexpediente', $tramite->expediente);
        }
    
        
    }
    public function destroy($id)
    {
        //
    }
}
