<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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

Route::get('/admin/create', function () {
    if (Auth::check() && Auth::user()->roles_id === 2) {
        return view('admin.create');
    } else {
        return redirect('/');
    }
})->name('admin.create');

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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.store');
Route::post('/admin/update/{id}', [AdminController::class, 'update'])->middleware('auth');
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->middleware('auth');
