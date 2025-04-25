<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'nombre', 'apellido', 'dni', 'fecha_ingreso', 'categoria_id', 'sueldo_basico',
        'estado', 'cuil', 'fecha_nacimiento', 'direccion', 'telefono'
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
