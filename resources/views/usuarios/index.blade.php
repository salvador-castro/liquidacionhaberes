@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Usuarios</h1>
        <a href="{{ route('usuarios.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow">
            + Agregar nuevo usuario
        </a>
    </div>

    <!-- Buscador -->
    <form method="GET" action="{{ route('usuarios.index') }}" class="mb-6">
        <div class="relative">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Buscar por nombre o apellido" 
                class="w-full pl-10 pr-4 py-2 rounded-lg shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white"
            >
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </form>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Rol</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $usuario->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $usuario->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ method_exists($usuario, 'getRoleNames') ? $usuario->getRoleNames()->implode(', ') : 'Sin rol' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                            <!-- Botón Editar (gris) -->
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" 
                                class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-1 px-3 rounded-lg shadow text-sm mr-2 inline-flex items-center gap-1">
                                <i class="fas fa-edit"></i>Editar
                            </a>

                            <!-- Botón Eliminar (rojo) -->
                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')"
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg shadow text-sm inline-flex items-center gap-1">
                                    <i class="fas fa-trash"></i>Eliminar
                                </button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
    </div>
</div>
@endsection
