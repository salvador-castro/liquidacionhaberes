<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'cuil',
        'fecha_ingreso',
        'fecha_egreso',      // <- AGREGADO
        'legajo',            // <- AGREGADO
        'categoria_id',
        'estado',
        'direccion',
        'telefono',
        'fecha_nacimiento',
        'sueldo_basico',
        'user_id',           // <- AGREGADO
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function liquidaciones()
    {
        return $this->hasMany(Liquidacion::class);
    }
}
