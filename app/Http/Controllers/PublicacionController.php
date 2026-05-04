<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\CentroLibro;
use Illuminate\Support\Facades\Auth;
use App\Models\SolicitudIntercambio;

/**
 * CONTROLADOR DE PUBLICACIONES: GESTIONA LAS PUBLICACIONES DE LOS USUARIOS:
 * - index(): Listado público de publicaciones con filtros por etapa, curso y asignatura
 * - misPublicaciones(): Listado de las publicaciones del usuario autenticado
 * - create(): Formulario de creación de publicación
 * - store(): Guardar nueva publicación
 * - show(): Mostrar detalle de una publicación
 * - edit(): Formulario de edición de publicación (solo para el propietario)
 * - update(): Actualizar publicación (solo para el propietario)
 * - destroy(): Borrado lógico de publicación (solo para el propietario)
 * - En el listado público, se excluyen las publicaciones que el usuario autenticado ya ha solicitado (en estado pendiente o aceptada)
 * - En el detalle de la publicación, se muestra si el usuario autenticado ya ha solicitado esa publicación (si existe una solicitud pendiente o aceptada)
 * - En el formulario de creación, se muestran los libros disponibles en el centro del usuario autenticado para seleccionar
 * - En el formulario de edición, solo se permite editar la descripción (no el libro ni la imagen) para simplificar
 */

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
        ])

        // SOLO PUBLICACIONES ACTIVAS (estado 3 = publicada)
        ->where('estado_id', 3);

        // FILTROS POR ETAPA, CURSO Y ASIGNATURA
        // Contemplo la posibilidad de que se apliquen uno o varios filtros a la vez
        if ($request->filled('etapa_id') || $request->filled('curso_id') || $request->filled('asignatura_id')) {

            $query->whereHas('centroLibro.libro', function ($q) use ($request) {

                if (!empty($request->etapa_id)) {
                    $q->whereHas('curso', function ($q2) use ($request) {
                        $q2->where('etapa_id', $request->etapa_id);
                    });
                }

                if (!empty($request->curso_id)) {
                    $q->where('curso_id', $request->curso_id);
                }

                if (!empty($request->asignatura_id)) {
                    $q->where('asignatura_id', $request->asignatura_id);
                }
            });
        }

        // Si el usuario está autenticado, excluyo las publicaciones que ya ha solicitado (pendiente o aceptada)
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
                'usuario',
                'estado'
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

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('publicaciones', 'public');
        } else {
            $rutaImagen = 'images/no-image.png';
        }

        $centroLibro = CentroLibro::findOrFail($request->centro_libro_id);

        if ($centroLibro->libro->estado_id != 1)// el libro no está activo
        {
            return back()->with('error', 'El libro seleccionado no está activo para este curso');
        }

        Publicacion::create([
            'usuario_id' => Auth::id(),
            'centros_libro_id' => $request->centro_libro_id,
            'descripcion' => $request->descripcion,
            'estado_id' => 3,
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

        $solicitudUsuario = null;

        if (auth()->check()) {
            $solicitudUsuario = SolicitudIntercambio::where('publicacion_id', $publicacion->id)
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

        // estado 12 = eliminada
        $publicacion->estado_id = 12;
        $publicacion->save();

        // Rechazar automáticamente las solicitudes pendientes de esta publicación
        SolicitudIntercambio::where('publicacion_id', $publicacion->id)
            ->where('estado_id', 8)
            ->update(['estado_id' => 10]);

       return back()->with('success', 'Publicación eliminada');
    }
}
