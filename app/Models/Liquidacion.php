<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    protected $table = 'liquidaciones';

    protected $fillable = [
        'empleado_id',
        'periodo',
        'fecha_liquidacion',
        'bruto',
        'descuentos',
        'neto',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleLiquidacion::class);
    }
}
