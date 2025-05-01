<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- si usás Vite --}}
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <header class="bg-white dark:bg-gray-800 shadow p-4">
        @if (isset($header))
            <div class="max-w-7xl mx-auto">
                {{ $header }}
            </div>
        @endif
    </header>

    <main class="max-w-7xl mx-auto p-6">
        {{ $slot }}
    </main>
</body>
</html>
