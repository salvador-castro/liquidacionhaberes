@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 px-4">
    <div class="text-center">
        <div class="flex justify-center mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-1.414 1.414M5.636 5.636l1.414 1.414m0 0L18.364 18.364M6.636 18.364l11.728-11.728" />
            </svg>
        </div>
        <h1 class="text-6xl font-bold text-gray-800 dark:text-white mb-4">403</h1>
        <p class="text-2xl text-gray-600 dark:text-gray-300 mb-6">Acceso Denegado</p>
        <p class="text-md text-gray-500 dark:text-gray-400 mb-8">No tenés los permisos necesarios para acceder a esta página.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-lg shadow-md">
                Ir al Inicio
            </a>
        </div>
    </div>
</div>
@endsection