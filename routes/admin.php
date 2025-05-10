<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ConocimientoController;
use App\Http\Controllers\BitacoraController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('admin.dashboard');
})->middleware(['auth:sanctum', 'verified'])->name('dashboard');


#Usuarios
Route::resource('users', UserController::class);    
Route::get('bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
Route::get('conocimiento', [ConocimientoController::class, 'index'])->name('conocimiento.index');
Route::get('conocimiento-create', [ConocimientoController::class, 'create'])->name('conocimiento.create');
Route::post('conocimiento', [ConocimientoController::class, 'store'])->name('conocimiento.store');
Route::get('conocimiento/{conocimiento}/edit', [ConocimientoController::class, 'edit'])->name('conocimiento.edit');
Route::put('conocimiento/{conocimiento}', [ConocimientoController::class, 'update'])->name('conocimiento.update');
Route::delete('conocimiento-destroy/{id}', [ConocimientoController::class, 'destroy'])->name('conocimiento.destroy');