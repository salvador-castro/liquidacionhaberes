<?php

namespace App\Http\Controllers;

use App\Models\Liquidacion;
use App\Models\Empleado;
use App\Models\DetalleLiquidacion;
use App\Models\Concepto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiquidacionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,id',
            'periodo' => 'required|date_format:Y-m',
            'fecha_liquidacion' => 'nullable|date',
            'conceptos' => 'required|array',
            'conceptos.*.concepto_id' => 'required|exists:conceptos,id',
            'conceptos.*.cantidad' => 'required|numeric|min:0',
            'conceptos.*.monto_unitario' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $empleado = Empleado::findOrFail($request->empleado_id);

            $bruto = 0;
            $descuentos = 0;

            $liquidacion = Liquidacion::create([
                'empleado_id' => $empleado->id,
                'periodo' => $request->periodo,
                'fecha_liquidacion' => $request->fecha_liquidacion ?? now(),
                'bruto' => 0,
                'descuentos' => 0,
                'neto' => 0,
            ]);

            foreach ($request->conceptos as $detalle) {
                $concepto = Concepto::findOrFail($detalle['concepto_id']);
                $subtotal = $detalle['cantidad'] * $detalle['monto_unitario'];

                DetalleLiquidacion::create([
                    'liquidacion_id' => $liquidacion->id,
                    'concepto_id' => $concepto->id,
                    'cantidad' => $detalle['cantidad'],
                    'monto_unitario' => $detalle['monto_unitario'],
                    'subtotal' => $subtotal,
                ]);

                if ($concepto->tipo === 'remunerativo' || $concepto->tipo === 'no_remunerativo') {
                    $bruto += $subtotal;
                }

                if ($concepto->tipo === 'descuento') {
                    $descuentos += $subtotal;
                }
            }

            $neto = $bruto - $descuentos;

            $liquidacion->update([
                'bruto' => $bruto,
                'descuentos' => $descuentos,
                'neto' => $neto,
            ]);

            DB::commit();

            return response()->json(['message' => 'Liquidación generada correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al generar liquidación.', 'detalle' => $e->getMessage()], 500);
        }
    }
}
