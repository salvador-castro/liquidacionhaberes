<div class="mb-3">
    <label>Nombre</label>
    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $empleado->nombre) }}">
</div>

<div class="mb-3">
    <label>Apellido</label>
    <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $empleado->apellido) }}">
</div>

<div class="mb-3">
    <label>DNI</label>
    <input type="text" name="dni" class="form-control" value="{{ old('dni', $empleado->dni) }}">
</div>

<div class="mb-3">
    <label>CUIL</label>
    <input type="text" name="cuil" class="form-control" value="{{ old('cuil', $empleado->cuil) }}">
</div>

<div class="mb-3">
    <label>Fecha de Ingreso</label>
    <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', $empleado->fecha_ingreso) }}">
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
</div>

<div class="mb-3">
    <label>Sueldo Básico</label>
    <input type="number" name="sueldo_basico" class="form-control" value="{{ old('sueldo_basico', $empleado->sueldo_basico) }}">
</div>

<div class="mb-3">
    <label>Estado</label>
    <select name="estado" class="form-control">
        <option value="activo" @selected(old('estado', $empleado->estado) === 'activo')>Activo</option>
        <option value="inactivo" @selected(old('estado', $empleado->estado) === 'inactivo')>Inactivo</option>
    </select>
</div>

<div class="mb-3">
    <label>Fecha de Nacimiento</label>
    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $empleado->fecha_nacimiento) }}">
</div>

<div class="mb-3">
    <label>Dirección</label>
    <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $empleado->direccion) }}">
</div>

<div class="mb-3">
    <label>Teléfono</label>
    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $empleado->telefono) }}">
</div>

<button type="submit" class="btn btn-success">Guardar</button>
<a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver</a>
