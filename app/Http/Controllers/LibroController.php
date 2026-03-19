<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;

class LibroController extends Controller
{
        public function index()
    {
        $libros = Libro::with('curso','asignatura')->get();

        return view('libros.index', compact('libros'));
    }
}

