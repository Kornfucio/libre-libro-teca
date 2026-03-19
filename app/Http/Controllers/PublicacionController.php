<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\CentroLibro;
use App\Models\Estado;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $publicaciones=Publicacion::with([
        'usuario',
        'centroLibro.libro.curso',
        'centroLibro.libro.asignatura',
        'estado'
       ])
       ->where('estado_id', 3) //Muestra los libros que están publicados
       ->latest()
       ->paginate(10);

       return view ('publicaciones.index', compact('publicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centroId=Auth::user()->centro_id;

        $centroLibros=CentroLibro::with('libro')
        ->where('centro_id',$centroId)
        ->get();

        return view ('publicaciones.create', compact('centroLibros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'centros_libro_id'=>'required|exists:centro_libro,id',
            'descripcion'=>'nullable|string|max:500'
        ]);

        Publicacion::create([
            'usuario_id'=> Auth::id(),
            'centros_libro_id'=> $request->centro_libro_id,
            'descripcion'=> $request->descripcion,
            'estado_id' =>3,
            'fecha_publicacion'=>now()
        ]);

        return redirect()
            ->route('publicaciones.index')
            ->with('success','Publicación creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publicacion= Publicacion::with([
            'usuario',
            'centroLibro.libro.curso',
            'centroLibro.libro.asignatura',
            'solicitudes.usuario',
            'estado'
        ])
        ->where('estado_id', 1)
        ->findOrFail($id);

        return view('publicaciones.show', compact('publicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $publicacion=Publicacion::findOrFail($id);

       if($publicacion->usuario_id != Auth::id()) {
        abort(403);
       }

       return view('publicaciones.edit', compact('publicacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $publicacion=Publicacion::findOrFail($id);

        if($publicacion->usuario_id != Auth::id()) {
        abort(403);
       }

       $request->validate(['descripcion'=>'nullable|string|max:500']);
        $publicacion->update(['descripcion'=>$request->descripcion]);
       return redirect()
            ->route('publicaciones.show',$publicacion->id)
            ->with('success','Publicación actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publicacion=Publicacion::findOrFail($id);

        if($publicacion->usuario_id != Auth::id()) {
        abort(403);
        }

        $publicacion->update(['estado_id', 12 ]); //borrado lógico, sólo no lo mostramos, no borramos publicaciones

        return redirect()
            ->route('publicaciones.index')
            ->with('success', 'Publicación eliminada');
    }
}
