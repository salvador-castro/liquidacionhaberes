<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        return view('usuarios.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,id',
        ]);

        $roleName = Role::find($request->role)->name;

        // Si es RRHH, solo puede asignar el rol empleado empresa
        if (auth()->user()->hasRole('rrhh') && $roleName !== 'empleado empresa') {
            return redirect()->back()->withErrors('No tenés permisos para asignar este rol.');
        }

        $user->syncRoles($roleName);

        return redirect()->route('usuarios.index')->with('success', 'Rol asignado correctamente.');
    }
}