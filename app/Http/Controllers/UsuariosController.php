<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View; // ✅ CORRECTO: esto va acá arriba, fuera de la clase

class UsuariosController extends Controller
{
    public function __construct()
    {
        // Solo Super Admin y RRHH pueden acceder a este controlador
        $this->middleware(['role:Super Admin|RRHH']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $usuarios = \App\Models\User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);
    
        return view('usuarios.index', compact('usuarios')); // ✅ Esta línea es indispensable
    }    

    public function create()
    {
        return view('usuarios.create');
    }

    public function edit(User $user)
    {
        return view('usuarios.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }
}
