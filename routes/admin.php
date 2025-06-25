<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\PermisoController;
use App\Http\Controllers\Admin\OfertaController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\CandidatoController;
use App\Http\Controllers\Admin\ConocimientoController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\Reclutador\ReclutadorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

Route::get('/', function () {
    return view('admin.dashboard');
})->middleware(['auth:sanctum', 'verified'])->name('dashboard');


#Usuarios
Route::resource('users', UserController::class);

//Ruta Bitácora
Route::get('bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');

// Ruta Conocimiento
Route::get('conocimiento', [ConocimientoController::class, 'index'])->name('conocimiento.index');
Route::get('conocimiento-create', [ConocimientoController::class, 'create'])->name('conocimiento.create');
Route::post('conocimiento', [ConocimientoController::class, 'store'])->name('conocimiento.store');
Route::get('conocimiento/{conocimiento}/edit', [ConocimientoController::class, 'edit'])->name('conocimiento.edit');
Route::put('conocimiento/{conocimiento}', [ConocimientoController::class, 'update'])->name('conocimiento.update');
Route::delete('conocimiento-destroy/{id}', [ConocimientoController::class, 'destroy'])->name('conocimiento.destroy');

// Ruta permiso
Route::get('permiso', [PermisoController::class, 'index'])->name('permiso.index');
Route::get('permiso-create', [PermisoController::class, 'create'])->name('permiso.create');
Route::post('permiso', [PermisoController::class, 'store'])->name('permiso.store');
Route::get('permiso/{permiso}/edit', [PermisoController::class, 'edit'])->name('permiso.edit');
Route::put('permiso/{permiso}', [PermisoController::class, 'update'])->name('permiso.update');
Route::delete('permiso-destroy/{id}', [PermisoController::class, 'destroy'])->name('permiso.destroy');

//ruta Rol
Route::resource('rol', RolController::class);
//ruta Reclutador
Route::get('reclutador', [ReclutadorController::class, 'index'])->name('reclutador.index');

//ruta Candidato
Route::resource('candidato', CandidatoController::class);

// get -> solo muestra datos
// post -> 
// put -> 
// delete ->
// resource -> engloba todos los tipo de rutas