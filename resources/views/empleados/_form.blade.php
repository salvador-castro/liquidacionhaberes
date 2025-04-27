<div class="mb-3">
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $empleado->nombre) }}">
    @error('nombre')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Apellido</label>
    <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $empleado->apellido) }}">
    @error('apellido')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>DNI</label>
    <input type="text" name="dni" class="form-control" value="{{ old('dni', $empleado->dni) }}">
    @error('dni')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>CUIL</label>
    <input type="text" name="cuil" class="form-control" value="{{ old('cuil', $empleado->cuil) }}">
    @error('cuil')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Fecha de Ingreso</label>
    <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', $empleado->fecha_ingreso) }}">
    @error('fecha_ingreso')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Categoría</label>
    <select name="categoria_id" class="form-control">
        <option value="">-- Seleccionar --</option>
        @foreach(App\Models\Categoria::all() as $categoria)
            <option value="{{ $categoria->id }}" @if(old('categoria_id', $empleado->categoria_id) == $categoria->id) selected @endif>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
    @error('categoria_id')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Sueldo Básico</label>
    <input type="number" name="sueldo_basico" class="form-control" value="{{ old('sueldo_basico', $empleado->sueldo_basico) }}">
    @error('sueldo_basico')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Estado</label>
    <select name="estado" class="form-control">
        <option value="activo" @selected(old('estado', $empleado->estado) === 'activo')>Activo</option>
        <option value="inactivo" @selected(old('estado', $empleado->estado) === 'inactivo')>Inactivo</option>
    </select>
    @error('estado')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Fecha de Nacimiento</label>
    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $empleado->fecha_nacimiento) }}">
    @error('fecha_nacimiento')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Dirección</label>
    <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $empleado->direccion) }}">
    @error('direccion')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $empleado->telefono) }}">
    @error('telefono')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-success">Guardar</button>
<a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver</a>