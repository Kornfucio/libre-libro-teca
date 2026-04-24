<?php

namespace App\Http\Controllers\Admin;

use App\Models\CentroEducativo;
use App\Models\Estado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CentroController extends Controller
{
    // LISTADO
    public function index()
    {
        $centros = CentroEducativo::with('estado')->paginate(10);
        return view('admin.centros.index', compact('centros'));
    }

    // FORMULARIO CREAR
    public function create()
    {
        $estados = Estado::all();
        return view('admin.centros.create', compact('estados'));
    }

    // GUARDAR
    public function store(Request $request)
{
    $request->validate([
        'nombre_centro' => 'required|string|max:255',
        'cif_centro' => 'required|string|max:255|unique:centros_educativos,cif_centro',
        'direccion' => 'nullable|string|max:255',
        'localidad' => 'nullable|string|max:255',
        'provincia' => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'email' => 'required|email|max:255',
        'estado_id' => 'required|exists:estados,id',
    ]);

    CentroEducativo::create([
        'nombre_centro' => $request->nombre_centro,
        'cif_centro' => $request->cif_centro,
        'direccion' => $request->direccion,
        'localidad' => $request->localidad,
        'provincia' => $request->provincia,
        'telefono' => $request->telefono,
        'email' => $request->email,
        'estado_id' => $request->estado_id,
    ]);

    return redirect()->route('admin.centros.index')
        ->with('success', 'Centro creado correctamente');
}

    // EDITAR
    public function edit(CentroEducativo $centro)
    {
        $estados = Estado::all();
        return view('admin.centros.edit', compact('centro', 'estados'));
    }

    // ACTUALIZAR
    public function update(Request $request, CentroEducativo $centro)
    {
        $request->validate([
            'nombre_centro' => 'required|string|max:255',
            'estado_id' => 'required|exists:estados,id'
        ]);

        $centro->update($request->only('nombre', 'estado_id'));

        return redirect()->route('admin.centros.index')
            ->with('success', 'Centro actualizado');
    }
}
