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
        return redirect()->route('incidencias.index');
    } else {
        return redirect('/');
    }
})->name('client');

Route::get('/manager', [GestorController::class, 'incidencias'])->name('manager');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/incidencias', [IncidenciaController::class, 'index'])->name('incidencias.index');
    Route::get('/incidencias/create', [IncidenciaController::class, 'create'])->name('incidencias.create');
    Route::post('/incidencias', [IncidenciaController::class, 'store'])->name('incidencias.store');
    Route::get('/incidencias/{id}', [IncidenciaController::class, 'show'])->name('incidencias.show');
    Route::post('/incidencias/{id}/comentarios', [IncidenciaController::class, 'addComment'])->name('incidencias.addComment');
    Route::patch('/incidencias/{id}/close', [IncidenciaController::class, 'close'])->name('incidencias.close');
});
Route::get('/categorias/{id}/subcategorias', function($id) {
    $subcategorias = Subcategoria::where('categorias_id', $id)->get();
    return response()->json($subcategorias);
})->name('categorias.subcategorias');

Route::get('/tecnico', function () {
    if (Auth::check() && Auth::user()->rol_id === 4) {
        return redirect()->route('tecnico.home');
    }
    return redirect('/');
})->name('tecnico');

Route::prefix('tecnico')
    ->name('tecnico.')
    ->group(function () {
        Route::get('/', [TecnicoController::class, 'dashboard'])->name('home');

        Route::get('/incidencias', [TecnicoController::class, 'incidenciasIndex'])->name('incidencias.index');
        Route::get('/incidencias/create', [TecnicoController::class, 'incidenciasCreate'])->name('incidencias.create');
        Route::post('/incidencias', [TecnicoController::class, 'incidenciasStore'])->name('incidencias.store');
        Route::get('/incidencias/{id}', [TecnicoController::class, 'incidenciasShow'])->name('incidencias.show');
        Route::get('/incidencias/{id}/edit', [TecnicoController::class, 'incidenciasEdit'])->name('incidencias.edit');
        Route::put('/incidencias/{id}', [TecnicoController::class, 'incidenciasUpdate'])->name('incidencias.update');
        Route::delete('/incidencias/{id}', [TecnicoController::class, 'incidenciasDestroy'])->name('incidencias.destroy');
});
Route::get('/admin', [AdminController::class, 'index'])->name('admin.admin');
Route::get('/admin/create', [AdminController::class, 'create'])->middleware('auth')->name('admin.create');
Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/update/{id}', [AdminController::class, 'edit'])->middleware('auth');
Route::post('/admin/update/{id}', [AdminController::class, 'update'])->middleware('auth');
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->middleware('auth')->name('admin.delete');
Route::get('/admin/disable/{id}', [AdminController::class, 'disable'])->name('admin.disable');
Route::get('/admin/enable/{id}', [AdminController::class, 'enable'])->name('admin.enable');
Route::get('/admin/create/category', [AdminController::class, 'createCategory'])->name('admin.create.category');
Route::post('/admin/create/category', [AdminController::class, 'storeCategory'])->name('admin.store.category');
Route::get('/admin/create/subcategory', [AdminController::class, 'createSubcategory'])->name('admin.create.subcategory');
Route::post('/admin/create/subcategory', [AdminController::class, 'storeSubcategory'])->name('admin.store.subcategory');


