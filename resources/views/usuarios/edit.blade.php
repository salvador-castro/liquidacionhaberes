<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Rol de Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="role">
                            Seleccioná un Rol
                        </label>
                        <select name="role" id="role" class="block mt-1 w-full rounded-md dark:bg-gray-700 dark:text-white">
                            @foreach($roles as $id => $name)
                                <option value="{{ $id }}" {{ $user->roles->first()?->id == $id ? 'selected' : '' }}>
                                    {{ ucfirst($name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ route('usuarios.index') }}" class="text-gray-600 hover:text-gray-900 dark:hover:text-white">
                            Volver
                        </a>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>