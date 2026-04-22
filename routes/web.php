<?php

use Illuminate\Support\Facades\Route;

/* Controladores usuario*/
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\SolicitudIntercambioController;

/* Controladores admin */
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PublicacionController as AdminPublicacionController;
use App\Http\Controllers\Admin\SolicitudController;
use App\Http\Controllers\Admin\CentroController;
use App\Http\Controllers\Admin\LibroController;


/*
RUTA PRINCIPAL
*/
Route::get('/', function () {
    return view('welcome');
});


/*
RUTAS DE USUARIO (LOGIN)
Rutas normales cuando el usuario está logueado
*/
Route::middleware(['auth'])->group(function () {

    // Publicaciones del usuario
    Route::resource('publicaciones', PublicacionController::class);

    // Solicitudes
    Route::get('/solicitudes', [SolicitudIntercambioController::class, 'index'])
        ->name('solicitudes.index');

    Route::post('/solicitudes', [SolicitudIntercambioController::class, 'store'])
        ->name('solicitudes.store');

    Route::patch('/solicitudes/{id}/cancelar', [SolicitudIntercambioController::class, 'cancelar'])
        ->name('solicitudes.cancelar');
});


/*
RUTAS DE ADMIN
Solo para administradores
*/
Route::middleware(['auth', 'isadmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::patch('/users/{user}/block', [UserController::class, 'block'])->name('users.block');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Publicaciones
    Route::get('/publicaciones', [AdminPublicacionController::class, 'index'])
        ->name('publicaciones.index');

    Route::get('/publicaciones/{id}/edit', [AdminPublicacionController::class, 'edit'])
        ->name('publicaciones.edit');

    Route::put('/publicaciones/{id}', [AdminPublicacionController::class, 'update'])
        ->name('publicaciones.update');

    Route::delete('/publicaciones/{id}', [AdminPublicacionController::class, 'destroy'])
        ->name('publicaciones.destroy');

    // Solicitudes
    Route::get('/solicitudes', [SolicitudController::class, 'index'])
        ->name('solicitudes.index');

    Route::get('/solicitudes/{id}', [SolicitudController::class, 'show'])
        ->name('solicitudes.show');

    Route::patch('/solicitudes/{id}/cancelar', [SolicitudController::class, 'cancelar'])
        ->name('solicitudes.cancelar');

    Route::patch('/solicitudes/{id}/finalizar', [SolicitudController::class, 'finalizar'])
        ->name('solicitudes.finalizar');

    // Centros
    Route::get('/centros', [CentroController::class, 'index'])
        ->name('centros.index');

    // Libros
    Route::get('/libros', [LibroController::class, 'index'])
        ->name('libros.index');


});

// Páginas informativas (menú lateral)

    Route::view('/quienes-somos', 'info.quienes-somos')->name('quienes');

    Route::view('/colaboradores', 'info.colaboradores')->name('colaboradores');

    Route::view('/compromisos', 'info.compromisos')->name('compromisos');

// Entradas del footer
    Route::view('/aviso-legal', 'info.aviso-legal')->name('aviso-legal');

    Route::view('/ayuda', 'info.ayuda')->name('ayuda');

    Route::view('/contacto', 'info.contacto')->name('contacto');

//Home del usuario

    Route::get('/', function () {
        return view('welcome');
    })->name('home');


    require __DIR__.'/auth.php';
