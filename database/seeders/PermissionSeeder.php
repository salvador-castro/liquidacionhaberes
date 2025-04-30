<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
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
            // 👇 Agregamos permisos de gestión de usuarios
            'ver usuarios',
            'editar usuarios',
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
            'ver usuarios', // (agregado también a RRHH si querés)
        ]);

        // Asignar permisos al Empleado empresa
        $empleado->syncPermissions([
            'ver empleados',
            'ver liquidaciones',
        ]);
    }
}
