<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GestorController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/client', function () {
    if (Auth::check() && Auth::user()->roles_id === 1) {
        // Redirige a la ruta de incidencias para que se ejecute el controlador
        return redirect()->route('incidencias.index');
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