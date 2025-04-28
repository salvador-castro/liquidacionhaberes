<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.force-password-change');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',      // debe tener una letra minúscula
                'regex:/[A-Z]/',      // debe tener una letra mayúscula
                'regex:/[0-9]/',      // debe tener un número
                'regex:/[@$!%*?&]/',  // debe tener un símbolo
            ],
        ], [
            'password.regex' => 'La contraseña debe tener al menos una mayúscula, una minúscula, un número y un símbolo (@$!%*?&).'
        ]);

        $user = Auth::user();

        // Verificar que no esté intentando usar la misma contraseña provisoria
        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'La nueva contraseña no puede ser igual a la anterior.',
            ]);
        }

        // Si pasa las validaciones, actualizar
        $user->password = Hash::make($request->password);
        $user->password_changed = true;
        $user->save();

        return redirect()->route('dashboard')->with('success', '¡Contraseña actualizada correctamente!');
    }
}