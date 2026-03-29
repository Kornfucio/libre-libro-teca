<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\SolicitudIntercambioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('publicaciones', PublicacionController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/publicaciones/{publicacion}/solicitar', [SolicitudIntercambioController::class, 'store'])
    ->name('solicitudes.store')
    ->middleware('auth');

Route::get('/solicitudes', [SolicitudIntercambioController::class, 'index'])
    ->name('solicitudes.index')
    ->middleware('auth');

Route::post('/publicaciones/{publicacion}/solicitar', [SolicitudIntercambioController::class, 'store'])
    ->name('solicitudes.store')
    ->middleware('auth');

Route::post('/solicitudes/{id}/aceptar', [SolicitudIntercambioController::class, 'aceptar'])
    ->name('solicitudes.aceptar')
    ->middleware('auth');

Route::post('/solicitudes/{id}/rechazar', [SolicitudIntercambioController::class, 'rechazar'])
    ->name('solicitudes.rechazar')
    ->middleware('auth');

Route::get('/mis-publicaciones', [PublicacionController::class, 'misPublicaciones'])
    ->name('publicaciones.mias')
    ->middleware('auth');

Route::get('/', function () {
    return view('welcome');
    })->name('home');

Route::view('/quienes-somos', 'info.quienes-somos')->name('quienes');
Route::view('/colaboradores', 'info.colaboradores')->name('colaboradores');
Route::view('/compromisos', 'info.compromisos')->name('compromisos');

Route::view('/aviso-legal', 'info.aviso-legal')->name('aviso-legal');
Route::view('/contacto', 'info.contacto')->name('contacto');
Route::view('/ayuda', 'info.ayuda')->name('ayuda');

require __DIR__.'/auth.php';
