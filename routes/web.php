<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/admin', function () {
    if (Auth::check() && Auth::user()->roles_id === 1) {
        return view('admin.admin');
    } else {
        return redirect('/');
    }
})->name('admin');

Route::get('/client', function () {
    if (Auth::check() && Auth::user()->roles_id === 2) {
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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
