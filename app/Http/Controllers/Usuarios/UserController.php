<?php

namespace App\Http\Controllers\Usuarios;
use App\Http\Requests\UserFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Areas;
use App\Cargos;
use App\Personas;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('administrador');
    }
    
    public function index(Request $request)
    {
     
        $Listarroles = Roles::all();
        $Listarareas = Areas::all();
        $Listarcargos = Cargos::all();
        $Listarpersonas = Personas::where('tipo_persona', 'funcionario')->get();
  
       if($request){
          $query = trim($request->get('buscar'));
          
           $Listarusuarios =User::join('personas', 'users.persona_id', '=', 'personas.id')
           ->where('personas.name','LIKE','%'.$query.'%')
           ->select('users.*','personas.name')
           ->orderBy('id','asc')
           ->get();
 
           return view('usuarios.usuarios',['Listarusuarios' => $Listarusuarios,'buscar'=>$query,'Listarroles'=>$Listarroles,'Listarareas'=>$Listarareas,'Listarcargos'=>$Listarcargos,'Listarpersonas'=> $Listarpersonas]);

        }
     
    }

    public function create()
    {
        //
    }

    public function store(UserFormRequest $request)
    {
        $nuevousuario = new User();
        $nuevousuario -> username = $request->username;
        $nuevousuario -> persona_id =$request->get('persona');
        
        $nuevousuario -> email = $request->email;
        $nuevousuario -> password = bcrypt( $request->password);
        $nuevousuario -> estado = 'activado';
   
        $nuevousuario->save();
     
        $nuevousuario->asignarRol($request->get('rol'));

        $nuevousuario->asignarArea($request->get('area'));
        $nuevousuario->asignarCargo($request->get('cargo'));
        return redirect('/usuarios');
    }

    public function show($id)
    {
        $usuarios= User::find($id);
      

        if($usuarios->estado=='desactivado'){
            $usuarios->estado='activado';
            $usuarios->save();
            return redirect ('/usuarios');
        }
        else{
            $usuarios->estado='desactivado';
            $usuarios->save();
            return redirect ('/usuarios');
        }
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $nuevousuario = User::findOrFail($id);
        $nuevousuario -> name = $request->get('name');
        $nuevousuario -> email = $request->get('email');
        $nuevousuario -> password =bcrypt($request->get('password'));
        $nuevousuario->asignarRol($request->get('rol'));
        $nuevousuario->asignarArea($request->get('area'));
        $nuevousuario->asignarArea($request->get('cargo'));
        $nuevousuario->update();
        return redirect ('/usuarios');
    }

    public function destroy($id)
    {
        
    }
    
}
