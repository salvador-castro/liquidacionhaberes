<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleLiquidacion extends Model
{
    protected $table = 'detalle_liquidacion';

    protected $fillable = [
        'liquidacion_id',
        'concepto_id',
        'cantidad',
        'monto_unitario',
        'subtotal',
    ];

    public function liquidacion()
    {
        return $this->belongsTo(Liquidacion::class);
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class);
    }
}
