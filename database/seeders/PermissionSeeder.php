<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Eliminar roles y permisos existentes (opcional, en entorno de desarrollo)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos generales
        $permisos = [
            'ver empleados',
            'crear empleados',
            'editar empleados',
            'eliminar empleados',
            'ver liquidaciones',
            'generar liquidaciones',
            'ver categorias',
            'crear categorias',
            'editar categorias',
            'eliminar categorias',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Crear roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $rrhh = Role::firstOrCreate(['name' => 'RRHH']);
        $empleado = Role::firstOrCreate(['name' => 'Empleado Empresa']);


        // Asignar todos los permisos al Super Admin
        $superAdmin->syncPermissions(Permission::all());

        // Asignar permisos a RRHH
        $rrhh->syncPermissions([
            'ver empleados',
            'crear empleados',
            'editar empleados',
            'ver liquidaciones',
            'generar liquidaciones',
            'ver categorias',
        ]);

        // Asignar permisos al Empleado empresa (sólo consulta)
        $empleado->syncPermissions([
            'ver empleados',
            'ver liquidaciones',
        ]);
    }
}