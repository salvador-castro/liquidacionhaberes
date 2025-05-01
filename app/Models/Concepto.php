<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $fillable = [
        'nombre',
        'codigo',
        'tipo',
        'fijo',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleLiquidacion::class);
    }
}
