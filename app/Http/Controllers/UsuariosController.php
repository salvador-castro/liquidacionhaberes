<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;
use App\Mail\SolicitudCambioPassword;
use Illuminate\Support\Facades\Mail;

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
        $roles = Role::pluck('name', 'id'); // [id => name] para el select
        return view('usuarios.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|exists:roles,id',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
            $user->password_changed = false;
            Mail::to($user->email)->send(new SolicitudCambioPassword($user));
        }

        $user->save();

        $role = \Spatie\Permission\Models\Role::findById($data['role']);
        $user->syncRoles([$role->name]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
}
}