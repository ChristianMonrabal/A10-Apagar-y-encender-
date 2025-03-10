<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TecnicoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tecnicos', [TecnicoController::class, 'index'])->name('tecnicos.index');
Route::post('/tecnicos/{id}/status', [TecnicoController::class, 'updateStatus']);
// Route::post('/tecnicos/{id}/message', [TecnicoController::class, 'sendMessage']); // Desactivado por el momento
