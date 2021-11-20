<?php

namespace App\Http\Controllers\Personas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Personas;
class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('administrador');
    }
    public function index()
    {
        $Listarperonas = Personas::all();
        return view('personas.persona',['Listarperonas' => $Listarperonas]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $nuevopersona = new Personas();
        $nuevopersona->dni=$request->dni;
        $nuevopersona->name=$request->name;
        $nuevopersona->celular=$request->celular;
        $nuevopersona->tipo_persona=$request->get('tipo_persona');
        $nuevopersona->save();
     
        return redirect('/personas');
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
