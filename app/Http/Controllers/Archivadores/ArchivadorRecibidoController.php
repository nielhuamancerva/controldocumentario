<?php

namespace App\Http\Controllers\Archivadores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Archivadores;
use App\Areas;
use App\Documentos;
use App\Tramites;
use App\Envio;
use App\TramitesInternosEstadosDocumentos;
use Illuminate\Support\Facades\DB;
use App\Traits\UserService;
use App\Traits\DocumentoDetalleService;
use App\Traits\ExpedienteService;
use App\Traits\RemitentePersonaService;
class ArchivadorRecibidoController extends Controller
{
    use UserService;
    use DocumentoDetalleService;
    use ExpedienteService;
    use RemitentePersonaService;
    public function __construct()
    {
        $this->middleware('empleado');
    }
    public function index( Request $request)
    {
        $buscararea=$this->BuscarArea();
        if($request){
 
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
    

            $insertarselectarchivadores=DB::table('archivadores')
            ->join('documentos', 'archivadores.documento_id', '=', 'documentos.id')
            ->where([['archivadores.area_id','=',$buscararea],['tipo_archivador','=','ARCHIVADO']])
            ->select('archivadores.area_id','archivadores.documento_id','documentos.documento','tipo_archivador')
            ->get();


            $Listarcantidadenvio=DB::table('cantidad_envio_area')
            ->join('cantidad_envio', 'cantidad_envio.id_cantidad_envio', '=', 'cantidad_envio_area.nombre_cantidad_envio_id')
            ->select('cantidad_envio_area.nombre_cantidad_envio_id','cantidad_envio.nombre_cantidad_envio')
            ->where('cantidad_envio_area.area_id','=',$buscararea)->get();

            $ListarArchivadoresBandeja = DB::table('detalles_documentos')
            ->join('detalles_documentos_estado', 'detalles_documentos.id','=','detalles_documentos_estado.detalles_documento_id')
            ->join('documentos', 'detalles_documentos.documento_id', '=', 'documentos.id')
            ->join('areas', 'detalles_documentos.area_id', '=', 'areas.id')
            ->where([['detalles_documentos_estado.Areadestino','=',$buscararea],['detalles_documentos_estado.uso_documento','=',1],['detalles_documentos_estado.estado_documento','=','ARCHIVADO'],['documento','LIKE','%'.$request->get('buscartipodocumento').'%']])
            ->select('documentos.documento','detalles_documentos_estado.detalles_documento_id','areas.area','detalles_documentos.NumeroDoc','detalles_documentos.Siglas','detalles_documentos.asunto','detalles_documentos.expediente','detalles_documentos_estado.detalles_documento_id','detalles_documentos_estado.estado_documento')
            ->get();         

            return view('archivadores.archivadorarchivados',['ListarArchivadoresBandeja' => $ListarArchivadoresBandeja,'insertarselectarchivadores'=>$insertarselectarchivadores,'Listardocumentos' => $Listardocumentos,'Listarareas'=>$Listarareas,'Listarenvio'=>$Listarenvio,'Listarcantidadenvio'=>$Listarcantidadenvio]);
        } 
    }

    public function create()
    {
        //
    }
public function EnviarProveidoArchivado(Request $request, $id){
    $tramite= TramitesInternosEstadosDocumentos::where([['detalles_documento_id','=',$id],['uso_documento','=',1],['estado_documento','=','ARCHIVADO']])->first();
    $tramite->uso_documento=0;
    if($tramite->save()){

        $mensaje=$this->Guardar_Estado_Documento($tramite->Areadestino,$request->get('tipoenvio'),$tramite->detalles_documento_id,$request->get('areas'),
        'ENVIADO',1,$request->nota,$tramite->origen_detalles_documento_id,$tramite->contador_detalles_documento_id,$tramite->secuencia_detalles_documento_id);
        return redirect ('/archivadoresrecibidos')->with('reenvioexpediente', $tramite->expediente);
    }
}
    public function store()
    {
          
        
    
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
        $tramite= TramitesInternosEstadosDocumentos::where([['detalles_documento_id','=',$idexpediente],['uso_documento','=',1],['estado_documento','=','ARCHIVADO']])->first();
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
                return redirect('/archivadoresrecibidos')->with('expedientes', $mensaje);
        }
      
    }
    public function destroy($id)
    {
        //
    }
   
}
