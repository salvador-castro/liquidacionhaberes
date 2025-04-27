@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalle del Empleado</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $empleado->nombre }} {{ $empleado->apellido }}</h5>
            <p class="card-text"><strong>DNI:</strong> {{ $empleado->dni }}</p>
            <p class="card-text"><strong>CUIL:</strong> {{ $empleado->cuil }}</p>
            <p class="card-text"><strong>Fecha de Ingreso:</strong> {{ $empleado->fecha_ingreso }}</p>
            <p class="card-text"><strong>Categoría:</strong> {{ $empleado->categoria->nombre ?? 'Sin categoría' }}</p>
            <p class="card-text"><strong>Sueldo Básico:</strong> ${{ number_format($empleado->sueldo_basico, 2, ',', '.') }}</p>
            <p class="card-text"><strong>Estado:</strong> {{ ucfirst($empleado->estado) }}</p>
            <p class="card-text"><strong>Fecha de Nacimiento:</strong> {{ $empleado->fecha_nacimiento }}</p>
            <p class="card-text"><strong>Dirección:</strong> {{ $empleado->direccion ?? 'No especificada' }}</p>
            <p class="card-text"><strong>Teléfono:</strong> {{ $empleado->telefono ?? 'No especificado' }}</p>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning">Editar</a>
        <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('¿Estás seguro que quieres eliminar este empleado?')">Eliminar</button>
        </form>
    </div>
</div>
@endsection
