<?php

namespace App\Http\Controllers\Documentos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Documentos;
class DocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('administrador');
    }
    public function index()
    {
        $Listardocumentos = Documentos::all();
        return view('Documentos.documentos',['Listardocumentos' => $Listardocumentos])->with('resultado','niel');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $nuevodocumento = new Documentos();
        $nuevodocumento->documento = $request->documentos;
        $nuevodocumento -> clacificaciondocumento = $request->get('clasificaciondocumento');
        $nuevodocumento->save();
        return redirect('/documentos')->with('documento',$nuevodocumento->documento);
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
        $nuevodocumento = Documentos::findOrFail($id);
        $nuevodocumento -> documento = $request->documentos;
        $nuevodocumento -> clacificaciondocumento = $request->get('clasificaciondocumento');
        $nuevodocumento->update();
        return redirect ('/documentos');
    }

    public function destroy($id)
    {
        //
    }
}
