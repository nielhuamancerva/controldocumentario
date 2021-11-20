<?php

namespace App\Http\Middleware;

use Closure;

class empleado
{

    public function handle($request, Closure $next)
    {
        $UsuarioLogeado=\Auth::User()->tieneRol();
        if(isset($UsuarioLogeado))
        {
            if($UsuarioLogeado =='empleado' || $UsuarioLogeado == 'tramitador'){
                return $next($request);
            }
        }
        return redirect('home');
    }
}
