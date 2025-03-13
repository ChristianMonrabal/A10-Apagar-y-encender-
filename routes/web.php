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


