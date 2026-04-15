<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Publicacion;

class AdminController extends Controller
{
    //Controlador para la vista de administración, protegido por el middleware isadmin para que solo los usuarios con rol de administrador puedan acceder

    public function index()
    {
        return view('dashboard.admin', [
            'usuarios' => User::count(),
            'publicaciones' => Publicacion::count(),
        ]);
    }
}
