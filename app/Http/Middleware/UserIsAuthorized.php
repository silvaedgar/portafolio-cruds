<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Facades\VerifyPermissionsFacade;

class UserIsAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    // 1ero validar que este logueado hacerlo en la ruta
    public function handle(Request $request, Closure $next, $permissions): Response
    {
        if (auth()->check()) {
            if (VerifyPermissionsFacade::checkPermissions(explode(";", $permissions))) {
                return $next($request);
            }
            return redirect("/")->with('message', 'No esta autorizado para acceder a la opción seleccionada');
        }
        return redirect("/")->with('message', 'Debe estar logueado para acceder a la opción seleccionada');
    }
}
