<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::create(['nombre' => 'Administrativo']);
        Categoria::create(['nombre' => 'Técnico']);
        Categoria::create(['nombre' => 'Operario']);
    }
}
