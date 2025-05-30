<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;

Route::get('/', function () {
    return view('welcome');
});

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
