<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GestorController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
