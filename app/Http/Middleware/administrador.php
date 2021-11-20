<?php

namespace App\Http\Middleware;

use Closure;

class administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $UsuarioLogeado=\Auth::User()->tieneRol();
      
        if(isset($UsuarioLogeado))
        {
            if($UsuarioLogeado!='administrador'){
                return redirect('home');
            }
        }
        return $next($request);
    }
}
