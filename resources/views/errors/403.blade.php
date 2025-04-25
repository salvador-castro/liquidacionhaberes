<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-red-600 dark:text-red-400">403</h1>
            <h2 class="mt-4 text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Acceso no autorizado
            </h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                No tenés permiso para acceder a esta página.
            </p>
            <div class="mt-6">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Volver al Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
