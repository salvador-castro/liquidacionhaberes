<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuentaPendiente extends Model
{
    protected $fillable = ['empleado_id', 'monto', 'concepto', 'fecha'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}