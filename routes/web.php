<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\SolicitudIntercambioController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PublicacionController as AdminPublicacionController; //Importación del controlador de publicaciones para la sección de administración con un alias para evitar conflictos con el controlador de publicaciones general
use App\Http\Controllers\Admin\SolicitudController;
use App\Http\Controllers\Admin\CentroController;
use App\Http\Controllers\Admin\LibroController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('publicaciones', PublicacionController::class)->except(['show']); //Protegemos el show para controlar que acceden usuarios logeados

Route::get('/publicaciones/{publicacion}', [PublicacionController::class, 'show']) //Aplicamos el middleware auth solo al show y redirigimos al login si no están autenticados
    ->middleware('auth')
    ->name('publicaciones.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rutas protegidas por el middleware isadmin para que solo los usuarios con rol de administrador puedan acceder a estas secciones de administración
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/publicaciones', [AdminPublicacionController::class, 'index'])->name('publicaciones.index');

    Route::get('/solicitudes', [SolicitudController::class, 'index'])->name('solicitudes.index');

    Route::get('/centros', [CentroController::class, 'index'])->name('centros.index');

    Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');

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

Route::post('/solicitudes/{id}/cancelar', [SolicitudIntercambioController::class, 'cancelar'])
    ->name('solicitudes.cancelar')
    ->middleware('auth');

require __DIR__.'/auth.php';
