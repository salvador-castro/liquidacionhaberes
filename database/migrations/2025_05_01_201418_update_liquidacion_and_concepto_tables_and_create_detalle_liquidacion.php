<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLiquidacionAndConceptoTablesAndCreateDetalleLiquidacion extends Migration
{
    public function up(): void
    {
        // Modificar tabla conceptos
        Schema::table('conceptos', function (Blueprint $table) {
            $table->string('nombre')->after('id');
            $table->string('codigo')->nullable()->after('nombre');
            $table->enum('tipo', ['remunerativo', 'no_remunerativo', 'descuento'])->after('codigo');
            $table->boolean('fijo')->default(false)->after('tipo');
        });

        // Modificar tabla liquidaciones
        Schema::table('liquidaciones', function (Blueprint $table) {
            $table->unsignedBigInteger('empleado_id')->after('id');
            $table->string('periodo')->after('empleado_id'); // formato YYYY-MM
            $table->date('fecha_liquidacion')->nullable()->after('periodo');
            $table->decimal('bruto', 10, 2)->default(0)->after('fecha_liquidacion');
            $table->decimal('descuentos', 10, 2)->default(0)->after('bruto');
            $table->decimal('neto', 10, 2)->default(0)->after('descuentos');
        });

        // Crear tabla detalle_liquidacion
        Schema::create('detalle_liquidacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('liquidacion_id');
            $table->unsignedBigInteger('concepto_id');
            $table->decimal('cantidad', 10, 2);
            $table->decimal('monto_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            $table->foreign('liquidacion_id')->references('id')->on('liquidaciones')->onDelete('cascade');
            $table->foreign('concepto_id')->references('id')->on('conceptos');
        });
    }

    public function down(): void
    {
        Schema::table('conceptos', function (Blueprint $table) {
            $table->dropColumn(['nombre', 'codigo', 'tipo', 'fijo']);
        });

        Schema::table('liquidaciones', function (Blueprint $table) {
            $table->dropColumn(['empleado_id', 'periodo', 'fecha_liquidacion', 'bruto', 'descuentos', 'neto']);
        });

        Schema::dropIfExists('detalle_liquidacion');
    }
}