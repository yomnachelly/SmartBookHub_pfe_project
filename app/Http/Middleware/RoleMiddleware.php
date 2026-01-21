<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = strtolower(trim(Auth::user()->role));
        $requiredRole = strtolower(trim($role));
        
        if ($userRole !== $requiredRole) {
            if ($requiredRole === 'employee' && in_array($userRole, ['employee', 'employe', 'employé'])) {
                return $next($request);
            }
            
            if ($requiredRole === 'admin' && $userRole === 'admin') {
                return $next($request);
            }
            
            if ($requiredRole === 'client' && $userRole === 'client') {
                return $next($request);
            }
            
            return redirect('/')->with('error', 'Accès non autorisé.');
        }

        return $next($request);
    }
}