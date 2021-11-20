<?php

namespace App\Http\Middleware;

use Closure;

class tramitador
{

    public function handle($request, Closure $next)
    {
        $UsuarioLogeado=\Auth::User()->tieneRol();
        if(isset($UsuarioLogeado))
        {
            if($UsuarioLogeado!='tramitador'){
                return redirect('home');
            }
        }
        return $next($request);
    }
}
