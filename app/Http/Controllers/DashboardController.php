<?php

namespace App\Http\Controllers;
use App\Models\Publicacion;
use App\Models\User;
use App\Models\SolicitudIntercambio;

//Controlardor para mostrar el dashboard con estadísticas generales
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalPublicaciones' => Publicacion::count(),
            'totalUsuarios' => User::count(),
            'totalSolicitudes' => SolicitudIntercambio::count(),
        ]);
    }
}
