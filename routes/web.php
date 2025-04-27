<?php

use App\Http\Controllers\JugadorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [EquipoController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('equipos/create', [EquipoController::class, 'create'])->name('equipos.create');

    Route::post('equipos', [EquipoController::class, 'store'])->name('equipos.store');

    Route::get('equipos/{equipo}/edit', [EquipoController::class, 'edit'])->name('equipos.edit');

    Route::put('equipos/{equipo}', [EquipoController::class, 'update'])->name('equipos.update');

    Route::delete('equipos/{equipo}', [EquipoController::class, 'destroy'])->name('equipos.destroy');

    Route::prefix('equipos/{equipo}')->group(function () {

        Route::get('jugadores', [JugadorController::class, 'index'])->name('jugadores.index');

        Route::get('jugadores/create', [JugadorController::class, 'create'])->name('jugadores.create');

        Route::post('jugadores', [JugadorController::class, 'store'])->name('jugadores.store');

        Route::get('jugadores/{jugador}/edit', [JugadorController::class, 'edit'])->name('jugadores.edit');

        Route::put('jugadores/{jugador}', [JugadorController::class, 'update'])->name('jugadores.update');

        Route::delete('jugadores/{jugador}', [JugadorController::class, 'destroy'])->name('jugadores.destroy');
    });
});

require __DIR__.'/auth.php';
