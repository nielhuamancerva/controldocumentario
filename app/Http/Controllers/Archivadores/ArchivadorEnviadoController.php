<?php

namespace App\Http\Controllers\Archivadores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Archivadores;
use App\Area;
use App\Documento;
use App\Tramites;
use App\Envio;
use App\Estado_Documento;
use Illuminate\Support\Facades\DB;
use App\Traits\UserService;
class ArchivadorEnviadoController extends Controller
{
    use UserService;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
   
        $buscararea=$this->BuscarArea();
    

        if($request){
            $insertarselectarchivadores=DB::table('archivadores')
            ->join('documentos', 'archivadores.documento_id', '=', 'documentos.id')
            ->where('archivadores.area_id','=',$buscararea)
            ->select('archivadores.area_id','archivadores.documento_id','documentos.documento')
            ->get();
            
            $ListarArchivadoresBandeja = DB::table('archivadores')
            ->join('documentos', 'archivadores.documento_id', '=', 'documentos.id')
            ->join('detalles_documentos', 'documentos.id', '=', 'detalles_documentos.documento_id')
            ->join('areas', 'detalles_documentos.area_id', '=', 'areas.id')
            ->where([['detalles_documentos.area_id','=',$buscararea],['detalles_documentos.area_id','=',$buscararea],['archivadores.area_id','=',$buscararea],['archivadores.tipo_archivador','=','ENVIADO'],['documento','LIKE','%'.$request->get('buscartipodocumento').'%']])
            ->select('archivadores.*','documentos.documento','areas.area','detalles_documentos.NumeroDoc','detalles_documentos.Siglas','detalles_documentos.asunto','detalles_documentos.expediente')
            ->get();
      

            return view('archivadores.archivadorenviados',['ListarArchivadoresBandeja' => $ListarArchivadoresBandeja,'insertarselectarchivadores'=>$insertarselectarchivadores]);
        }
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
