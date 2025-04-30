@extends('layouts.app')

@section('title', 'Cambio de contraseña obligatorio')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white text-center">
        Cambio de contraseña obligatorio
    </h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 dark:bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li class="dark:text-red-900">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nueva contraseña</label>
            <div class="relative">
                <input type="password" name="password" id="password"
                       class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm pr-10" required>
                <button type="button"
                        onclick="toggleVisibility('password', 'toggle-password-icon')"
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 dark:text-gray-300 focus:outline-none">
                    <i id="toggle-password-icon" class="fa-solid fa-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmar nueva contraseña</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full mt-1 p-2 rounded border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm pr-10" required>
                <button type="button"
                        onclick="toggleVisibility('password_confirmation', 'toggle-confirm-icon')"
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 dark:text-gray-300 focus:outline-none">
                    <i id="toggle-confirm-icon" class="fa-solid fa-eye"></i>
                </button>
            </div>
        </div>

        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Actualizar contraseña
        </button>
    </form>
</div>

<script>
    function toggleVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection