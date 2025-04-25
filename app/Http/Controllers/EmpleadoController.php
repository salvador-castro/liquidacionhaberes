<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|numeric|unique:empleados,dni',
            'fecha_ingreso' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
            'sueldo_basico' => 'required|numeric',
            'estado' => 'required|string',
            'cuil' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string',
        ]);

        Empleado::create($validated);

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
            'dni' => 'required|numeric|unique:empleados,dni,' . $empleado->id,
            'fecha_ingreso' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
            'sueldo_basico' => 'required|numeric',
            'estado' => 'required|string',
            'cuil' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string',
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