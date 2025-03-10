<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GestorController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/manager', [GestorController::class, 'incidencias'])->name('manager');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');