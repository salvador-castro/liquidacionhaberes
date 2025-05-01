@php
    use Illuminate\Support\Carbon;
    Carbon::setLocale('es');
    $ahora = Carbon::now();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                ¡Bienvenido, {{ Auth::user()->name ?? 'Usuario' }}!
            </h1>
            <div x-data="{
                    now: new Date(),
                    get time() {
                        return this.now.toLocaleTimeString('es-AR', { hour: '2-digit', minute: '2-digit', hour12: false });
                    },
                    init() {
                        setInterval(() => this.now = new Date(), 1000);
                    }
                }" class="mt-2 text-md text-gray-600 dark:text-gray-300">
                Hoy es <strong>{{ ucfirst($ahora->translatedFormat('l j \\d\\e F \\d\\e Y')) }}</strong>,
                son las <strong x-text="time"></strong> hs.
            </div>
        </div>

        <!-- MÉTRICAS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="text-gray-500 dark:text-gray-300">Empleados activos</div>
                <div class="mt-2 text-3xl font-semibold text-blue-600 dark:text-blue-400">{{ $empleadosActivos }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="text-gray-500 dark:text-gray-300">Liquidaciones este mes</div>
                <div class="mt-2 text-3xl font-semibold text-green-600 dark:text-green-400">{{ $liquidacionesMes }}</div>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="text-gray-500 dark:text-gray-300">Cuentas pendientes</div>
                <div class="mt-2 text-3xl font-semibold text-red-600 dark:text-red-400">{{ $cuentasPendientes }}</div>
            </div>
        </div>

        <!-- ENLACES RÁPIDOS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('empleados.index') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-4 rounded-lg shadow flex items-center justify-between">
                <span>Gestionar empleados</span>
                <i class="fas fa-users text-xl"></i>
            </a>

            <a href="{{ route('usuarios.index') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-4 rounded-lg shadow flex items-center justify-between">
                <span>Gestionar usuarios</span>
                <i class="fas fa-user-shield text-xl"></i>
            </a>

            <a href="{{ route('profile.edit') }}"
                class="bg-gray-700 hover:bg-gray-800 text-white font-semibold px-6 py-4 rounded-lg shadow flex items-center justify-between">
                <span>Mi perfil</span>
                <i class="fas fa-user-cog text-xl"></i>
            </a>
        </div>
    </div>
</x-app-layout>
