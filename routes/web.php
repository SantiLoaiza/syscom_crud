<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Ruta para mostrar el formulario de creación de usuario
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Ruta para guardar un nuevo usuario
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Otras rutas existentes
Route::get('/users/{id}/contract', [UserController::class, 'generateContract'])->name('users.contract');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
