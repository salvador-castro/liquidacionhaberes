<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamado ordenado de Seeders
        $this->call([
            CategoriaSeeder::class,
            PermissionSeeder::class,
        ]);

        // Crear usuario de prueba y asignarle rol
        $user = User::factory()->create([
            'name'  => 'Test User',
            'email' => 'salvacastro@frba.utn.edu.ar',
        ]);

        // Asignar rol 'super admin' al usuario
        $user->assignRole('super admin');
    }
}