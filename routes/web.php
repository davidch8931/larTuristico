<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\TipoAtraccionController;
use App\Http\Controllers\LugarTuristicoController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

// Rutas públicas (sin autenticación)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    Route::resource('provincias', ProvinciaController::class);
    Route::resource('tipoAtraccion', TipoAtraccionController::class);
    Route::resource('lugarTuristico', LugarTuristicoController::class);
    
    // Ruta del dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});