<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Traits\UserService;
use App\Persona;
class HomeController extends Controller
{
    use UserService;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
 
        return view('layouts.layout');
    
    }
    public function editar_password(Request $request, $id)
    {
        $nuevousuario = User::findOrFail($id);
        $nuevousuario ->password =bcrypt($request->get('password_general'));
        $nuevousuario->update();
        return redirect ('/usuarios');
    }

}
