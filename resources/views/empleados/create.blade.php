@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nuevo Empleado</h1>
    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf
        @include('empleados._form', ['empleado' => new \App\Models\Empleado])
    </form>
</div>
@endsection
