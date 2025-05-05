<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BitacoraController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('admin.dashboard');
})->middleware(['auth:sanctum', 'verified'])->name('dashboard');


#Usuarios
Route::resource('users', UserController::class);    
Route::get('bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');