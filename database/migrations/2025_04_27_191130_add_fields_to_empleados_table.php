<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->string('nombre')->after('id');
            $table->string('apellido')->after('nombre');
            $table->string('dni', 15)->after('apellido');
            $table->string('cuil', 20)->nullable()->after('dni');
            $table->date('fecha_ingreso')->nullable()->after('cuil');
            $table->date('fecha_egreso')->nullable()->after('fecha_ingreso');
            $table->string('legajo', 20)->nullable()->after('fecha_egreso');
            $table->unsignedBigInteger('categoria_id')->nullable()->after('legajo');
            $table->boolean('activo')->default(true)->after('categoria_id'); // 👈 Nuevo campo

            // Relación a la tabla categorias
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn([
                'nombre', 
                'apellido', 
                'dni', 
                'cuil', 
                'fecha_ingreso',
                'fecha_egreso',
                'legajo', 
                'categoria_id',
                'activo' // 👈 también eliminado si hacemos rollback
            ]);
        });
    }
};