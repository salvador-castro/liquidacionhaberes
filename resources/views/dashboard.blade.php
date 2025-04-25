@php
    use Illuminate\Support\Carbon;
    Carbon::setLocale('es');
    $ahora = Carbon::now();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @auth
                        <h1 class="text-2xl font-bold mb-4">
                            ¡Bienvenido, {{ Auth::user()->name }}!
                        </h1>

                        <p class="text-md mb-2">
                            Hoy es <strong>{{ ucfirst($ahora->translatedFormat('l j \\d\\e F \\d\\e Y')) }}</strong>,
                            son las <strong>{{ $ahora->format('H:i') }} hs</strong>.
                        </p>

                        <p class="text-md">
                            Estás logueado. Podés gestionar empleados, ver tu perfil o navegar por el sistema.
                        </p>
                    @else
                        <h1 class="text-2xl font-bold mb-4">
                            ¡Bienvenido!
                        </h1>
                        <p class="text-md">
                            Por favor, iniciá sesión para acceder al sistema.
                        </p>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
