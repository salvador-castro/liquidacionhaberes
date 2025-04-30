@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
        <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                       class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm" required>
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                       class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm" required>
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Contraseña Provisoria (opcional)
            </label>
            <div class="relative">
                <input type="password" name="password" id="password"
                    class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm pr-10">
                <button type="button"
                        onclick="togglePasswordVisibility()"
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600 dark:text-gray-300 focus:outline-none">
                    <i id="password-toggle-icon" class="fa-solid fa-eye"></i>
                </button>
            </div>
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <script>
            function togglePasswordVisibility() {
                const input = document.getElementById('password');
                const icon = document.getElementById('password-toggle-icon');

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

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rol</label>
                <select name="role" id="role"
                        class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white shadow-sm">
                    @foreach($roles as $id => $name)
                        <option value="{{ $id }}" {{ $user->roles->first()?->id == $id ? 'selected' : '' }}>
                            {{ ucfirst($name) }}
                        </option>
                    @endforeach
                </select>
                @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('usuarios.index') }}"
                   class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white transition">
                    ← Volver
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
