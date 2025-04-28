<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->bigInteger('dni')->unsigned()->change();
            $table->bigInteger('cuil')->unsigned()->nullable()->change();
            $table->bigInteger('legajo')->unsigned()->nullable()->change();
            $table->renameColumn('categoria_id', 'categoria');
        });
    }

    public function down(): void
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->string('dni', 15)->change();
            $table->string('cuil', 20)->nullable()->change();
            $table->string('legajo', 20)->nullable()->change();
            $table->renameColumn('categoria', 'categoria_id');
        });
    }
};