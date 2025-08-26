<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\GraficasController;
Route::get('usuarios/graficas', [GraficasController::class, 'index'])->name('usuarios.graficas');

use App\Http\Controllers\UsuarioController;
Route::resource('usuarios', UsuarioController::class);