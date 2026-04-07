<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\CentroLibro;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    /**
     * Listado público de publicaciones
     */
public function index(Request $request)
{
    $query = Publicacion::with([
        'usuario',
        'centroLibro.libro.curso',
        'centroLibro.libro.asignatura',
        'centroLibro.libro.etapa',
        'solicitudes'
    ]);

    // FILTROS POR ETAPA, CURSO Y ASIGNATURA
    $query->whereHas('centroLibro.libro', function ($q) use ($request) {

    $q->whereHas('curso', function ($q2) use ($request) {
       $q2->where('etapa_id', $request->etapa_id);
    });

    $q->when($request->curso_id, function ($q) use ($request) {
        $q->where('curso_id', $request->curso_id);
    });

    $q->when($request->asignatura_id, function ($q) use ($request) {
        $q->where('asignatura_id', $request->asignatura_id);
    });
    });

    // EVITAR PUBLICACIONES YA SOLICITADAS
    if (auth()->check()) {
        $query->whereDoesntHave('solicitudes', function ($q) {
            $q->where('usuario_id', auth()->id())
              ->whereIn('estado_id', [8, 9]);
        });
    }

    // PAGINACIÓN
    $publicaciones = $query->paginate(20)->withQueryString();

    // DATOS PARA LOS SELECTS
    $etapas = \App\Models\Etapa::all();
    $cursos = \App\Models\Curso::all();
    $asignaturas = \App\Models\Asignatura::all();

    return view('publicaciones.index', compact(
        'publicaciones',
        'etapas',
        'cursos',
        'asignaturas'
    ));
}

    /**
     * Listado de MIS publicaciones
     */
    public function misPublicaciones()
    {
        $publicaciones = Publicacion::with([
                'centroLibro.libro',
                'usuario'
            ])
            ->where('usuario_id', Auth::id())
            ->latest()
            ->get();

        return view('publicaciones.mis-publicaciones', compact('publicaciones'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        $centroId = Auth::user()->centro_id;

        $centroLibros = CentroLibro::with('libro')
            ->where('centro_id', $centroId)
            ->get();

        return view('publicaciones.create', compact('centroLibros'));
    }

    /**
     * Guardar publicación
     */
    public function store(Request $request)
    {
        $request->validate([
            'centro_libro_id' => 'required|exists:centros_libro,id',
            'descripcion' => 'nullable|string|max:500',
            'imagen' => 'nullable|image|max:2048',
            'condiciones' => 'accepted'
        ]);

        // Imagen
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('publicaciones', 'public');
        } else {
            $rutaImagen = 'images/no-image.png';
        }

        Publicacion::create([
            'usuario_id' => Auth::id(),
            'centros_libro_id' => $request->centro_libro_id,
            'descripcion' => $request->descripcion,
            'estado_id' => 3, // publicada
            'fecha_publicacion' => now(),
            'imagen' => $rutaImagen
        ]);

        return redirect()
            ->route('publicaciones.index')
            ->with('success', 'Publicación creada correctamente');
    }

    /**
     * Mostrar una publicación
     */
    public function show(string $id)
    {
        $publicacion = Publicacion::with([
            'usuario',
            'centroLibro.libro.curso',
            'centroLibro.libro.asignatura',
            'solicitudes.usuario',
            'estado'
        ])->findOrFail($id);

    //Comprobar si el usuario autenticado ya ha solicitado esta publicación
        // Obtener la solicitud del usuario autenticado (si existe)
        $solicitudUsuario = null;

    if (auth()->check()) {
        $solicitudUsuario = \App\Models\SolicitudIntercambio::where('publicacion_id', $publicacion->id)
            ->where('usuario_id', auth()->id())
            ->first();
    }

        return view('publicaciones.show', [
        'publicacion' => $publicacion,
        'solicitudUsuario' => $solicitudUsuario
     ]);
    }

    /**
     * Formulario de edición
     */
    public function edit(string $id)
    {
        $publicacion = Publicacion::findOrFail($id);

        if ($publicacion->usuario_id !== Auth::id()) {
            abort(403);
        }

        return view('publicaciones.edit', compact('publicacion'));
    }

    /**
     * Actualizar publicación
     */
    public function update(Request $request, string $id)
    {
        $publicacion = Publicacion::findOrFail($id);

        if ($publicacion->usuario_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'descripcion' => 'nullable|string|max:500'
        ]);

        $publicacion->update([
            'descripcion' => $request->descripcion
        ]);

        return redirect()
            ->route('publicaciones.show', $publicacion->id)
            ->with('success', 'Publicación actualizada');
    }

    /**
     * Borrado lógico
     */
    public function destroy(string $id)
    {
        $publicacion = Publicacion::findOrFail($id);

        if ($publicacion->usuario_id !== Auth::id()) {
            abort(403);
        }

        // estado 12 = eliminada (ajusta según tu tabla estados)
        $publicacion->update([
            'estado_id' => 12
        ]);

        return redirect()
            ->route('publicaciones.index')
            ->with('success', 'Publicación eliminada');
    }
}
