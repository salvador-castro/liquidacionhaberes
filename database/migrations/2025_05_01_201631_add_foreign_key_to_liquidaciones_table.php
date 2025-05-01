<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('liquidaciones', function (Blueprint $table) {
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('liquidaciones', function (Blueprint $table) {
            $table->dropForeign(['empleado_id']);
        });
    }
};

