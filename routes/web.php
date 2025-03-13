<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GestorController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TecnicoController;

use App\Http\Controllers\IncidenciaController;
use App\Models\Subcategoria;

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

Route::get('/admin/create', function () {
    if (Auth::check() && Auth::user()->roles_id === 2) {
        return view('admin.create');
    } else {
        return redirect('/');
    }
})->name('admin.create');

Route::get('/client', function () {
    if (Auth::check() && Auth::user()->roles_id === 1) {
        // Redirige a la ruta de incidencias para que se ejecute el controlador
        return redirect()->route('incidencias.index');
    } else {
        return redirect('/');
    }
})->name('client');

Route::controller(GestorController::class)->group(function () {
    Route::get('/manager', 'incidencias')->name('manager');
    Route::patch('/incidencias/{id}/tecnico', 'actualizarTecnico')->name('actualizarTecnico');
    Route::patch('/incidencias/{id}/prioridad', 'actualizarPrioridad')->name('actualizarPrioridad');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (se asume que se usa el middleware de autenticación)
Route::middleware(['auth'])->group(function () {
    Route::get('/incidencias', [IncidenciaController::class, 'index'])->name('incidencias.index');
    Route::get('/incidencias/create', [IncidenciaController::class, 'create'])->name('incidencias.create');
    Route::post('/incidencias', [IncidenciaController::class, 'store'])->name('incidencias.store');
    Route::get('/incidencias/{id}', [IncidenciaController::class, 'show'])->name('incidencias.show');
    Route::post('/incidencias/{id}/comentarios', [IncidenciaController::class, 'addComment'])->name('incidencias.addComment');
});
Route::get('/categorias/{id}/subcategorias', function($id) {
    // Se asume que la tabla subcategorias tiene una columna 'categorias_id'
    $subcategorias = Subcategoria::where('categorias_id', $id)->get();
    return response()->json($subcategorias);
})->name('categorias.subcategorias');

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
Route::get('/admin', [AdminController::class, 'index'])->name('admin.admin');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/update/{id}', [AdminController::class, 'edit'])->middleware('auth');
Route::post('/admin/update/{id}', [AdminController::class, 'update'])->middleware('auth');
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->middleware('auth')->name('admin.delete');
Route::get('/admin/disable/{id}', [AdminController::class, 'disable'])->name('admin.disable');
Route::get('/admin/enable/{id}', [AdminController::class, 'enable'])->name('admin.enable');
