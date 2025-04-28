@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Cambio de contraseña obligatorio</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Nueva contraseña</label>
            <input type="password" name="password" required class="w-full mt-2 p-2 border rounded">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700">Confirmar nueva contraseña</label>
            <input type="password" name="password_confirmation" required class="w-full mt-2 p-2 border rounded">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Actualizar contraseña
        </button>
    </form>
</div>
@endsection
