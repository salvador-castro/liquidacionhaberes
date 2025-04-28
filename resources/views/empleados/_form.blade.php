@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white shadow-md rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar empleado</h1>

        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">¡Oops!</strong>
                <span class="block">Hubo algunos problemas con tu entrada.</span>
                <ul class="mt-3 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nombre -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $empleado->nombre ?? '') }}" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('nombre')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Apellido -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $empleado->apellido ?? '') }}" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('apellido')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- DNI -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="dni">DNI</label>
                    <input type="text" name="dni" id="dni" value="{{ old('dni', $empleado->dni ?? '') }}" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('dni')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- CUIL -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cuil">CUIL</label>
                    <input type="number" name="cuil" id="cuil" value="{{ old('cuil', $empleado->cuil) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Fecha de ingreso -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_ingreso">Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" value="{{ old('fecha_ingreso', $empleado->fecha_ingreso) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Fecha de egreso -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_egreso">Fecha de Egreso</label>
                    <input type="date" name="fecha_egreso" id="fecha_egreso" value="{{ old('fecha_egreso', $empleado->fecha_egreso) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Legajo -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="legajo">Legajo</label>
                    <input type="text" name="legajo" id="legajo" value="{{ old('legajo', $empleado->legajo ?? '') }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('legajo')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Categoría -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="categoria_id">Categoría</label>
                    <select name="categoria_id" id="categoria_id"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seleccione categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $empleado->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->id }} - {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Estado -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="estado">Estado</label>
                    <select name="estado" id="estado" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Seleccione estado</option>
                        <option value="trabajando" {{ old('estado', $empleado->estado) == 'trabajando' ? 'selected' : '' }}>Trabajando</option>
                        <option value="jubilado" {{ old('estado', $empleado->estado) == 'jubilado' ? 'selected' : '' }}>Jubilado</option>
                        <option value="no activo" {{ old('estado', $empleado->estado) == 'no activo' ? 'selected' : '' }}>No activo</option>
                    </select>
                </div>

            </div>

            <div class="flex items-center justify-end mt-8">
                <a href="{{ route('empleados.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Cancelar</a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{ isset($empleado) ? 'Actualizar empleado' : 'Crear empleado' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection