<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Agrupamos las rutas protegidas
Route::middleware('auth')->group(function () {
    Route::resource('empleados', EmpleadoController::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Super Admin y RRHH pueden gestionar usuarios
    Route::middleware('role:super admin|rrhh')->group(function () {
        Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/{user}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{user}', [UsuariosController::class, 'update'])->name('usuarios.update');
    });
});

// Rutas de autenticación (login, register, etc.)
require __DIR__.'/auth.php';