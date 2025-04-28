<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PasswordChangeController; // <-- Agregado
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

    // Rutas para forzar cambio de contraseña
    Route::get('/password/change', [PasswordChangeController::class, 'showChangeForm'])->name('password.change');
    Route::post('/password/update', [PasswordChangeController::class, 'updatePassword'])->name('password.update');
});

// Rutas de autenticación (login, register, etc.)
require __DIR__.'/auth.php';
