<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Libro;
use App\Models\CentroEducativo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CentroLibro;
use App\Models\Curso;
use App\Models\Asignatura;

class LibroController extends Controller
{
    /**
     * Listado de libros (admin ve TODOS)
     */
    public function index()
    {
        $libros = Libro::with('centros')->paginate(10);

        return view('admin.libros.index', compact('libros'));
    }

    /**
     * Formulario crear
     */
    public function create()
    {

    $cursos=Curso::all();
    $asignaturas=Asignatura::all();

    return view('admin.libros.create', compact('cursos', 'asignaturas'));
    }

    /**
     * Guardar libro
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'nullable|string|max:255',
            'ISBN' => 'nullable|string|max:20',
            'curso_id' => 'required|exists:cursos,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'editorial' => 'nullable|string|max:255',

            // Centros activos
            'centros' => 'nullable|array',
            'centros.*' => [
                Rule::exists('centros_educativos', 'id')->where(function ($query) {
                    $query->where('estado_id', 1);
                }),
            ],
        ]);

        // Crear libro (estado activo por defecto)
        $libro = Libro::create([
            'titulo' => $request->titulo,
            'autor' => $request->autor,
            'ISBN' => $request->isbn,
            'curso_id' => $request->curso_id,
            'asignatura_id' => $request->asignatura_id,
            'editorial' => $request->editorial,
            'estado_id' => 1
        ]);

        //Redirigimos a la pantalla de asignar
        return redirect()->route('admin.libros.asignar', $libro)
            ->with('success', 'Libro creado correctamente, puedes asignarlo a centro/s');
    }

    /**
     * Formulario editar
     */
   public function edit(Libro $libro)
    {

    $cursos=Curso::all();
    $asignaturas=Asignatura::all();
    return view('admin.libros.edit', compact('libro', 'cursos', 'asignaturas'));
    }

    /**
     * Actualizar libro
     */
    public function update(Request $request, Libro $libro)
    {
        // Validación de datos del libro
        $request->validate([
        'titulo' => 'required|string|max:255',
        'autor' => 'nullable|string|max:255',
        'isbn' => 'nullable|string|max:20',
        'curso_id' => 'required|exists:cursos,id',
        'asignatura_id' => 'required|exists:asignaturas,id',
        'editorial' => 'nullable|string|max:255',
        'estado_id' => 'required|in:1,2',
        ]);

             // Actualización de datos
    $libro->update([
        'titulo' => $request->titulo,
        'autor' => $request->autor,
        'isbn' => $request->isbn,
        'curso_id' => $request->curso_id,
        'asignatura_id' => $request->asignatura_id,
        'editorial' => $request->editorial,
        'estado_id' => $request->estado_id
    ]);
        //Redirijo a la pantalla del listado de libros
        return redirect()->route('admin.libros.index', $libro)
            ->with('success', 'Libro actualizado correctamente');
    }

    /**
     * Eliminar (soft delete lógico)
     */
    public function destroy(Libro $libro)
    {
        $libro->estado_id = 2; // inactivo
        $libro->save();

        return redirect()->route('admin.libros.index')
            ->with('success', 'Libro desactivado correctamente');
    }

    /**
     * Ver detalle
     */
    public function show(Libro $libro)
    {
        //Cargar relaciones básicas del libro
        $libro->load(['curso', 'asignatura']);

        //Obtener asignaciones con datos del centro
        $asignaciones = CentroLibro::with('centro')
            ->where('libro_id', $libro->id)
            ->get();

        return view('admin.libros.show', compact('libro', 'asignaciones'));
    }

    /**
     * Asignar libro a centro (desde detalle)
     */
    public function asignar(Libro $libro)
{
    $centros = CentroEducativo::where('estado_id', 1)->get();

    // centros ya asignados
    $libro->load('centros');

    return view('admin.libros.asignar', compact('libro', 'centros'));
}

    /**
     * Guardar asignación de libro a centro
     */
    public function guardarAsignacion(Request $request, Libro $libro)
   {

    //Defino en una variable local el año académico, para que se grabe en cada libro creado.
    /*
    Debería cambiarse cada año académico
    */
    $anyoAcademico='2025-2026';

    // Validación: array de centros y que existan y estén activos
    $request->validate([
        'centros' => 'nullable|array',
        'centros.*' => [
            Rule::exists('centros_educativos', 'id')->where(function ($query) {
                $query->where('estado_id', 1); // solo centros activos
            }),
        ],
    ]);

    // Comprobación de seguridad: solo permitir si el libro está activo
    if ($libro->estado_id != 1) {
        abort(403, 'El libro no está activo');
    }

    $centrosSeleccionados= $request->centros ?? [];

    //Obtenemos asignaciones actuales de ese libro y año académico

    $actuales = CentroLibro::where('libro_id', $libro->id)
    ->where('anyo_academico', $anyoAcademico)
    ->get();

    //Obtener IDs actuales

    $idsActuales= $actuales->pluck('centro_id')->toArray();

    //Inserttamos los nuevos
        foreach ($centrosSeleccionados as $centroId) {
                if(!in_array($centroId, $idsActuales)) {
                CentroLibro::create([
                'libro_id' => $libro->id,
                'centro_id' => $centroId,
                'anyo_academico' => $anyoAcademico
            ]);
        }
    }

    //Eliminamos los quitados
        foreach($actuales as $relacion) {
            if(!in_array($relacion->centro_id, $centrosSeleccionados)) {
                //Solo borrar si NO tiene publicaciones
                if ($relacion->publicaciones()->count() ==0) {
                    $relacion->delete();
                }
            }
        }

    // Redirección con mensaje de confirmación
    return redirect()->route('admin.libros.show', $libro)
        ->with('success', 'Asignación de centros actualizada correctamente');
}
}
