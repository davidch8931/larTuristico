<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\TipoAtraccionController;
use App\Http\Controllers\LugarTuristicoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('provincias', ProvinciaController::class);
Route::resource('tipoAtraccion', TipoAtraccionController::class);
Route::resource('lugarTuristico', LugarTuristicoController::class);