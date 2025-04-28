<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $empleados = Empleado::query()
            ->when($search, function ($query, $search) {
                $query->where('nombre', 'like', "%{$search}%")
                      ->orWhere('apellido', 'like', "%{$search}%")
                      ->orWhere('dni', 'like', "%{$search}%");
            })
            ->orderBy('apellido')
            ->paginate(15);

        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        if (!auth()->user()->hasRole(['Super Admin', 'RRHH'])) {
            abort(403, 'No autorizado.');
        }

        $categorias = Categoria::all();
        return view('empleados.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasRole(['Super Admin', 'RRHH'])) {
            abort(403, 'No autorizado.');
        }

        // Logueamos todo lo que llega del formulario
        Log::debug('Formulario recibido:', $request->all());

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|numeric|unique:empleados,dni',
            'cuil' => 'nullable|numeric',
            'fecha_ingreso' => 'nullable|date',
            'legajo' => 'nullable|numeric',
            'categoria_id' => 'nullable|exists:categorias,id',
            'estado' => 'required|string|max:20',
            'rol' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Logueamos los datos validados
        Log::debug('Datos validados:', $validated);

        // Crear usuario
        $user = User::create([
            'name' => $validated['nombre'] . ' ' . $validated['apellido'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Asignar rol al usuario
        $user->assignRole($validated['rol']);

        // Crear empleado
        $empleado = Empleado::create([
            'user_id' => $user->id,
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'dni' => $validated['dni'],
            'cuil' => $validated['cuil'],
            'fecha_ingreso' => $validated['fecha_ingreso'],
            'legajo' => $validated['legajo'] ?? null,
            'categoria_id' => $validated['categoria_id'],
            'estado' => $validated['estado'],
        ]);

        // Logueamos el empleado creado
        Log::debug('Empleado creado:', $empleado->toArray());

        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
    }

    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.show', compact('empleado'));
    }

    public function edit($id)
    {
        if (!auth()->user()->hasRole(['Super Admin', 'RRHH'])) {
            abort(403, 'No autorizado.');
        }

        $empleado = Empleado::findOrFail($id);
        $categorias = Categoria::all();

        return view('empleados.edit', compact('empleado', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasRole(['Super Admin', 'RRHH'])) {
            abort(403, 'No autorizado.');
        }

        $empleado = Empleado::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|numeric|unique:empleados,dni,' . $empleado->id,
            'cuil' => 'nullable|numeric',
            'fecha_ingreso' => 'nullable|date',
            'fecha_egreso' => 'nullable|date',
            'legajo' => 'nullable|numeric',
            'categoria_id' => 'nullable|exists:categorias,id',
            'estado' => 'required|string|max:20',
        ]);

        $empleado->update($validated);

        if ($empleado->user) {
            $empleado->user->update([
                'name' => $validated['nombre'] . ' ' . $validated['apellido'],
            ]);
        }

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasRole(['Super Admin', 'RRHH'])) {
            abort(403, 'No autorizado.');
        }

        $empleado = Empleado::findOrFail($id);

        if ($empleado->user) {
            $empleado->user->delete();
        }

        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}