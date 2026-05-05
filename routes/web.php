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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;


/*
RUTA PRINCIPAL
*/
Route::get('/', function () {
    return view('welcome');
});

/*
RUTAS DE USUARIO GUEST
Rutas accesibles sin estar logueado
*/
Route::get('/publicaciones', [PublicacionController::class, 'index'])
        ->name('publicaciones.index');



/*
RUTAS DE USUARIO (LOGIN)
Rutas normales cuando el usuario está logueado
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // PUBLICACIONES

    Route::resource('publicaciones', PublicacionController::class)
        ->except(['show']);

    Route::get('/mis-publicaciones', [PublicacionController::class, 'misPublicaciones'])
        ->name('publicaciones.mias');

    Route::get('/publicaciones/{id}', [PublicacionController::class, 'show'])
        ->name('publicaciones.show');

    Route::get('/publicaciones/create', [PublicacionController::class, 'create'])
    ->name('publicaciones.create');

    // SOLICITUDES
    Route::resource('solicitudes', SolicitudIntercambioController::class)
    ->except(['store']);


    Route::post('/solicitudes/{publicacion}', [SolicitudIntercambioController::class, 'store'])
    ->name('solicitudes.store');

    Route::post('/solicitudes/{solicitud}/aceptar', [SolicitudIntercambioController::class, 'aceptar'])
        ->name('solicitudes.aceptar');

    Route::post('/solicitudes/{solicitud}/rechazar', [SolicitudIntercambioController::class, 'rechazar'])
    ->name('solicitudes.rechazar');

    Route::post('/solicitudes/{solicitud}/cancelar', [SolicitudIntercambioController::class, 'cancelar'])
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
    Route::resource('centros', CentroController::class)
        ->except(['show', 'destroy']);

    // Libros
     Route::resource('libros', LibroController::class);

     // Pantalla para asignar centros
    Route::get('libros/{libro}/asignar', [LibroController::class, 'asignar'])
        ->name('libros.asignar');

    // Guardar asignaciones
    Route::post('libros/{libro}/asignar', [LibroController::class, 'guardarAsignacion'])
        ->name('libros.guardarAsignacion');

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

//Home del usuario validado

    /*Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
    })->name('dashboard');*/


    require __DIR__.'/auth.php';
