<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-blue-600 dark:text-blue-400">404</h1>
            <h2 class="mt-4 text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Página no encontrada
            </h2>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                La página que estás buscando no existe o fue movida.
            </p>
            <div class="mt-6">
                <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Volver al Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
