<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        // Solo permitir Super Admin o RRHH
        if (!auth()->user()->hasRole(['Super Admin', 'RRHH'])) {
            abort(403, 'No autorizado.');
        }

        $categorias = Categoria::all();
        return view('empleados.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Solo permitir Super Admin o RRHH
        if (!auth()->user()->hasRole(['Super Admin', 'RRHH'])) {
            abort(403, 'No autorizado.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:15|unique:empleados,dni',
            'cuil' => 'nullable|string|max:20',
            'fecha_ingreso' => 'nullable|date',
            'legajo' => 'nullable|string|max:20',
            'categoria_id' => 'nullable|exists:categorias,id',
            'estado' => 'required|string|max:20',
            'rol' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Crear el empleado
        $empleado = Empleado::create([
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'dni' => $validated['dni'],
            'cuil' => $validated['cuil'],
            'fecha_ingreso' => $validated['fecha_ingreso'],
            'legajo' => $validated['legajo'],
            'categoria_id' => $validated['categoria_id'],
            'estado' => $validated['estado'],
        ]);

        // Crear el usuario asociado
        $user = User::create([
            'name' => $validated['nombre'] . ' ' . $validated['apellido'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Asignar el rol seleccionado
        $user->assignRole($validated['rol']);

        return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
    }

    public function show(string $id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.show', compact('empleado'));
    }

    public function edit(string $id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, string $id)
    {
        $empleado = Empleado::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:15|unique:empleados,dni,' . $empleado->id,
            'cuil' => 'nullable|string|max:20',
            'fecha_ingreso' => 'nullable|date',
            'legajo' => 'nullable|string|max:20',
            'categoria_id' => 'nullable|exists:categorias,id',
            'estado' => 'required|string|max:20',
        ]);

        $empleado->update($validated);

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}
