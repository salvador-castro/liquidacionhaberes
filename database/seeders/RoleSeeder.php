<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Ejecuta el seeder de roles.
     */
    public function run(): void
    {
        // Roles definidos según la tabla de referencia
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'RRHH']);
        Role::create(['name' => 'Empleado Empresa']);
    }
}