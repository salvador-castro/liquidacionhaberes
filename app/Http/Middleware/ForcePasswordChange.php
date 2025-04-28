<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForcePasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->password_changed) {
            // Si el usuario no cambió la contraseña, y no está ya en el formulario de cambio de contraseña...
            if (!$request->is('password/change', 'password/update')) {
                return redirect()->route('password.change');
            }
        }

        return $next($request);
    }
}