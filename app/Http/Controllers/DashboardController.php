<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Liquidacion;
use App\Models\CuentaPendiente; // Ajustá este import si usás otro modelo
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $empleadosActivos = Empleado::where('estado', 'trabajando')->count();

        $liquidacionesMes = Liquidacion::whereMonth('fecha_liquidacion', now()->month)
                                ->whereYear('fecha_liquidacion', now()->year)
                                ->count();

        $cuentasPendientes = CuentaPendiente::count(); // Reemplazá si usás otro modelo

        return view('dashboard', compact('empleadosActivos', 'liquidacionesMes', 'cuentasPendientes'));
    }
}
