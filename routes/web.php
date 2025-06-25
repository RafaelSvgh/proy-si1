<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->hasRole('admin')) {
        return view('admin.dashboard');
    } elseif ($user->hasRole('reclutador')) {
        return view('reclutador.dashboard');
    } else {
        return view('dashboard'); // vista genérica para otros roles o sin rol
    }
})->name('dashboard');
});

Route::get('inicio',[CandidatoController::class, 'welcome'])->name('candidato.welcome');
Route::post('postular/{ofertaId}', [CandidatoController::class, 'postular'])->name('candidato.postular');

