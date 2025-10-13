<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Comprobar si el usuario ha iniciado sesión
        if (!Auth::check()) {
            return redirect('login');
        }

        // Obtener el usuario actual
        $user = Auth::user();

        // Comprobar si el rol del usuario está en la lista de roles permitidos
        foreach ($roles as $role) {
            if ($user->rol === $role) {
                // Si el rol coincide, permitir el acceso
                return $next($request);
            }
        }

        // Si el bucle termina y no hay coincidencias, redirigir al dashboard correspondiente
        $dashboardRoute = match($user->rol) {
            'admin' => 'admin.dashboard',
            'doctor' => 'doctor.dashboard',
            default => 'paciente.dashboard',
        };

        return redirect()->route($dashboardRoute)->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
