<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Roles;
class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('administrador');
    }

    public function index()
    {
        $Listarroles = Roles::all();
        return view('roles.roles',['Listarroles' => $Listarroles]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $nuevorol = new Roles();
        $nuevorol -> name = $request->name;
        $nuevorol -> label = $request->label;
        $nuevorol -> estado_roles =  $request->get('estado_rol');
        $nuevorol->save();
   
        return redirect('/roles');
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
        $editarrole = Roles::findOrFail($id);
        $editarrole -> name = $request->name;
        $editarrole -> label = $request->label;
        $editarrole -> estado_roles =  $request->get('estado_roles');
        $editarrole->update();
        return redirect ('/roles');
    }

    public function destroy($id)
    {
        //
    }
}
