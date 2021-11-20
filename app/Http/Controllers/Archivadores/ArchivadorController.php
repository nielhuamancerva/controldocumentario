<?php

namespace App\Http\Controllers\Archivadores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Archivadores;
use App\Areas;
use App\Documentos;
use App\Tramites;
use App\Envio;
use App\Estado_Documento;
use Illuminate\Support\Facades\DB;
class ArchivadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('administrador');
    }
    public function index()
    {
        $Listararchivadores = DB::table('archivadores')
        ->join('documentos', 'archivadores.documento_id', '=', 'documentos.id')
        ->join('areas', 'archivadores.area_id', '=', 'areas.id')
        ->select('archivadores.*','documentos.documento','areas.area')
        ->get();
        $Listarareas=Areas::all();
        $Listardocumentos=Documentos::all();
        return view('archivadores.archivadores',['Listararchivadores' => $Listararchivadores,'Listarareas' =>  $Listarareas,'Listardocumentos' => $Listardocumentos]);
    }

   
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $nuevoarea = new Archivadores();
        $nuevoarea -> archivador = $request->get('nombre_archivador');
        $nuevoarea -> estado_archivador = 1;
        $nuevoarea -> codigo_archivador = $request->get('tipo_archivador');
        $nuevoarea -> area_id = $request->get('areas');
        $nuevoarea -> documento_id =$request->get('nombre_archivador');
        $ver=$request->get('tipo_archivador');
        if($ver==1)
        {
            $nuevoarea -> tipo_archivador ="ENVIADO";
            $nuevoarea ->save();
            return redirect('/archivadores');
        }
        $nuevoarea -> tipo_archivador ="ARCHIVADO";
        $nuevoarea ->save();
        return redirect('/archivadores');
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
