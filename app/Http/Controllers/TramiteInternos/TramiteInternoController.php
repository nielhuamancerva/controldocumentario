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
use App\TramitesInternosEstadosDocumentos;
use PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use App\Traits\UserService;
use App\Traits\DocumentoDetalleService;
use App\Traits\ExpedienteService;
use App\Traits\RemitentePersonaService;
class TramiteInternoController extends Controller
{
    use UserService;
    use DocumentoDetalleService;
    use ExpedienteService;
    use RemitentePersonaService;
    public function __construct()
    {
        $this->middleware('empleado');
    }
    public function index()
    {
  
        $buscararea=$this->BuscarArea();
        $Listartramites = DB::table('detalles_documentos')
            ->join('documentos', 'detalles_documentos.documento_id', '=', 'documentos.id')
            ->join('areas', 'detalles_documentos.area_id', '=', 'areas.id')
            ->join('detalles_documentos_estado', 'detalles_documentos.id', '=', 'detalles_documentos_estado.detalles_documento_id')
            ->where([['detalles_documentos_estado.Areadestino','=',$buscararea],['detalles_documentos_estado.uso_documento','=','1'],['detalles_documentos_estado.estado_documento','=','enviado']])
            ->select('detalles_documentos.*','areas.area','documentos.documento','detalles_documentos_estado.uso_documento','detalles_documentos_estado.detalles_documento_id')
            ->get();
        return view('tramitesinternos.tramiteinternobandeja',['Listartramites' => $Listartramites]);
    }
    public function create()
    {
        $buscararea=$this->BuscarArea();
        $Listarcantidadenvio=DB::table('cantidad_envio_area')
        ->join('cantidad_envio', 'cantidad_envio.id_cantidad_envio', '=', 'cantidad_envio_area.nombre_cantidad_envio_id')
        ->select('cantidad_envio_area.nombre_cantidad_envio_id','cantidad_envio.nombre_cantidad_envio')
        ->where('cantidad_envio_area.area_id','=',$buscararea)->get();
        
        $Listarenvio=DB::table('detalles_documentos_certifico_envio')->where('clase_envio_id','=','2')->get();
       
        $Listarareas =DB::table('acceso_envio_area')
        ->join('areas', 'acceso_envio_area.area_enviar', '=', 'areas.id')
        ->where('area_id','=',$buscararea)
        ->select('areas.id','areas.area')
        ->distinct()->get();
      
        $ListarDocumento=DB::table('acceso_envio_area')
        ->join('documentos','acceso_envio_area.documento_id','=','documentos.id')
        ->select('documentos.id','documentos.documento')
        ->where([['acceso_envio_area.area_id','=',$buscararea],['documentos.clacificaciondocumento','=','interno']])
        ->distinct()->get();

        return view('tramitesinternos.tramiteinternodocumento',['ListarDocumento'=>$ListarDocumento,'Listarareas'=>$Listarareas,'Listarenvio'=>$Listarenvio,'Listarcantidadenvio'=>$Listarcantidadenvio]);
    }

    public function store(Request $request)
    {
        $buscararea=$this->BuscarArea();
        $newexpediente =  $this->BuscarExpediente();

        $ids=$this->BuscarAreaId();
        $barea=$this->BuscarBarea();
        $FirmaRemitenteInterno=$this->RemitenteInterno();
 
        $mensaje=$this->GuardarDocumentoDetalle($newexpediente+1,$request->numerodoc,$request->siglasareas,$request->asunto,$ids,$request->get('documentos'),$request->get('cantidad_areas')
        ,$ids,$request->get('areas'),$request->get('tipoenvio')
        ,0,0,1,$barea,'ENVIADO',2,'--',$FirmaRemitenteInterno);
  
        return redirect('/tramitesinternos')->with('expediente', $mensaje);
    
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
   
    public function update(Request $request, $idexpediente)
    {
        $tramite= TramitesInternosEstadosDocumentos::where([['detalles_documento_id','=',$idexpediente],['uso_documento','=',1],['estado_documento','=','aceptado']])->first();
        $tramite->uso_documento=0;
        if($tramite->save()){
            $ids=$this->BuscarAreaId();
            $barea=$this->BuscarBarea();
            $FirmaRemitenteInterno=$this->RemitenteInterno();
            $exp = $this->RebuscarExpediente($idexpediente);

            $mensaje=$this->GuardarDocumentoDetalle($exp,$request->numerodoc,$request->siglasareas,$request->asunto,$ids,$request->get('documentos'),$request->get('cantidad_areas')
            ,$tramite->Areadestino,$request->get('areas'),$request->get('tipoenvio')
            ,$tramite->origen_detalles_documento_id+1,$tramite->contador_detalles_documento_id,$tramite->secuencia_detalles_documento_id,$barea
            ,'ENVIADO',2,'--',$FirmaRemitenteInterno);   

            return redirect('/tramitesinternos')->with('expediente', $mensaje);;
        }
    }

    public function destroy($id)
    {
        //
    }
    public function getnumeros(Request $request)
    {
        $buscararea=$this->BuscarArea();
        $SiglasArea =Areas::where('id','=',$buscararea)->select('siglas')->get();
        foreach ($SiglasArea as $Siglas => $SA) {
           
        }
        $nextnumero = $request->get('nextnumero');
      
        $numerodoc = DB::table('detalles_documentos')
        ->where([['documento_id','=',$nextnumero],['area_id','=',$buscararea]])
        ->select('NumeroDoc','siglas')
        ->orderBy('NumeroDoc', 'desc')
        ->first();
        
        if($numerodoc){
            $numerodoc=[0=>["NumeroDoc"=>$numerodoc->NumeroDoc+1,'siglas'=>$SA->siglas]];
            return response()->json($numerodoc);
        }
        $numerodoc=[0=>["NumeroDoc"=>1,'siglas'=>$SA->siglas]];
        return response()->json($numerodoc);
  
    }
    public function AreaEnvio(Request $request)
    {
        $ids=$this->BuscarAreaId();
        $destino = $request->get('nextnumero');

        $areaenviodestino = DB::table('acceso_envio_area')
        ->join('areas', 'acceso_envio_area.area_enviar', '=', 'areas.id')
        ->select('areas.id','areas.area')
        ->where([['acceso_envio_area.area_id','=', $ids],['acceso_envio_area.documento_id','=', $destino]])
        ->distinct()
        ->get();
        return response()->json($areaenviodestino);

  
    }
    public function recepcionado($id)
    {

        $tramite= TramitesInternosEstadosDocumentos::where([['detalles_documento_id','=',$id],['uso_documento','=',1],['estado_documento','=','ENVIADO']])->first();;
        $tramite->uso_documento=0;
        if($tramite->save()){
            $tramiteaceptado = new TramitesInternosEstadosDocumentos();
            $tramiteaceptado->Areainicio=$tramite->Areainicio;
            $tramiteaceptado->Areadestino=$tramite->Areadestino;
            $tramiteaceptado->uso_documento=1;
            $tramiteaceptado->estado_documento='ACEPTADO';
            $tramiteaceptado->tipoenvio_id=3;
            $tramiteaceptado->claseenvio_id = 1;
            $tramiteaceptado ->nota = '--';
            $tramiteaceptado->detalles_documento_id=$tramite->detalles_documento_id;
            $tramiteaceptado->origen_detalles_documento_id=$tramite->origen_detalles_documento_id;
            $tramiteaceptado->contador_detalles_documento_id=$tramite->contador_detalles_documento_id;
            $tramiteaceptado->secuencia_detalles_documento_id=$tramite->secuencia_detalles_documento_id;
            $tramiteaceptado->save();
            $expedientes=$tramite->expediente;
            return redirect ('/tramitesinternos')->with('expedientes', $expedientes);
        }
        
    }
 
    public function ReenvioDocumentoArchivar(Request $request,$id)
    {
        $tramite= TramitesInternosEstadosDocumentos::where([['detalles_documento_id','=',$id],['uso_documento','=',1],['estado_documento','=','ACEPTADO']])->first();
        $tramite->uso_documento=0;
        if($tramite->save())
        {
            $mensaje=$this->Guardar_Estado_Documento($tramite->Areadestino,5,$tramite->detalles_documento_id,$tramite->Areadestino,
            'ARCHIVADO',1,'--',$tramite->origen_detalles_documento_id,$tramite->contador_detalles_documento_id,$tramite->secuencia_detalles_documento_id);
            return redirect ('/tramitesinternosprocesos')->with('reenvioexpediente', $tramite->expediente);
        }
        
    }
}
