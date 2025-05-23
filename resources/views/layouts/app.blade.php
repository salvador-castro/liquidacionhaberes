<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} – @yield('title', 'Inicio') </title>

    <!-- Estilos -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation') <!-- si tenés navegación -->
        
        <!-- Contenido de cada página -->
        <main>
            {{-- Si $slot está definido, se usa (para <x-app-layout>) --}}
            @isset($slot)
                {{ $slot }}
            @endisset

            {{-- Si se usa @extends + @section --}}
            @yield('content')
        </main>
    </div>

</body>
</html>
