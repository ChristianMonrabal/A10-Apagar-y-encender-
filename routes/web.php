<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GestorController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TecnicoController;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/admin', function () {
    if (Auth::check() && Auth::user()->roles_id === 2) {
        return view('admin.admin');
    } else {
        return redirect('/');
    }
})->name('admin');

Route::get('/client', function () {
    if (Auth::check() && Auth::user()->roles_id === 1) {
        return view('client.client');
    } else {
        return redirect('/');
    }
})->name('client');

Route::get('/manager', function () {
    if (Auth::check() && Auth::user()->roles_id === 3) {
        return view('manager.manager');
    } else {
        return redirect('/');
    }
})->name('manager');







Route::get('/tecnico', function () {
    // Verifica que el usuario esté autenticado y tenga rol_id igual a 4 (técnico)
    if (Auth::check() && Auth::user()->rol_id === 4) {
        return redirect()->route('tecnico.home');
    }
    return redirect('/');
})->name('tecnico');

Route::prefix('tecnico')
    ->name('tecnico.')
    ->group(function () {
        // Dashboard del técnico
        Route::get('/', [TecnicoController::class, 'dashboard'])->name('home');

        // Rutas para la gestión de incidencias
        Route::get('/incidencias', [TecnicoController::class, 'incidenciasIndex'])->name('incidencias.index');
        Route::get('/incidencias/create', [TecnicoController::class, 'incidenciasCreate'])->name('incidencias.create');
        Route::post('/incidencias', [TecnicoController::class, 'incidenciasStore'])->name('incidencias.store');
        Route::get('/incidencias/{id}', [TecnicoController::class, 'incidenciasShow'])->name('incidencias.show');
        Route::get('/incidencias/{id}/edit', [TecnicoController::class, 'incidenciasEdit'])->name('incidencias.edit');
        Route::put('/incidencias/{id}', [TecnicoController::class, 'incidenciasUpdate'])->name('incidencias.update');
        Route::delete('/incidencias/{id}', [TecnicoController::class, 'incidenciasDestroy'])->name('incidencias.destroy');
});



