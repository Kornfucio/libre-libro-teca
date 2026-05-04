<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\User;
use App\Models\Estado;


class PublicacionController extends Controller
{
    public function index(Request $request)
    {
        // Cojo todas las publicaciones con sus relaciones (usuario y estado)
        $query = Publicacion::with(['usuario', 'estado']);

        // También obtengo usuarios y estados para poder filtrar desde la vista
        $usuarios = User::all();
        $estados = Estado::whereIn('id',[3,5,6,7,12])->get(); // solo los estados relevantes para admin, no se muestran los eliminados

        //Si quiero filtrar por usuario o estado, lo hago aquí con con $request->input('usuario') o $request->input('estado') y añadiendo condiciones a la query de publicaciones
        if ($request->filled('usuario')) {
            $query->where('usuario_id', $request->usuario);
        }
        if ($request->filled('estado')) {
            $query->where('estado_id', $request->input('estado'));
        }
        //Ordenación por fecha
        $query->latest();

        // Paginación con los filtros aplicados
        $publicaciones= $query->paginate(10)->withQueryString(); // mantengo los filtros en la paginación

        // Devuelvo la vista con los datos
        return view('admin.publicaciones.index', compact('publicaciones', 'usuarios', 'estados'));
    }


// Formulario de edición de una publicación
    public function edit($id)
    {
        // Busco la publicación o fallo si no existe
        $publicacion = Publicacion::findOrFail($id);

        // Cargo estados por si quiero cambiar el estado desde admin
        $estados = Estado::whereIn('id',[3,5,6,7,12])->get(); // solo los estados relevantes para publicaciones

        return view('admin.publicaciones.edit', compact('publicacion', 'estados'));
    }

     // Actualizar publicación (cuando envías el formulario)
public function update(Request $request, $id)
{
    $publicacion = Publicacion::findOrFail($id);

    // Validación
    $request->validate([
        'descripcion' => 'nullable|string',
        'estado_id' => 'required|exists:estados,id',
        'imagen' => 'nullable|string|max:255'
    ]);

    // Limpieza básica de descripción
    $descripcionLimpia = $request->descripcion
        ? strip_tags($request->descripcion)
        : null;

    // Actualización directa (sin tocar imagen realmente)
    $publicacion->update([
        'descripcion' => $descripcionLimpia,
        'estado_id' => $request->estado_id,
        'imagen' => $request->imagen // aquí simplemente guardas string
    ]);

    return redirect()->route('admin.publicaciones.index')
        ->with('success', 'Publicación actualizada correctamente');
}



// Eliminación (no se borra realmente, solo se marca como "eliminada" para no tener problemas de integridad referencial y para mantener un historial)
    public function destroy($id)
    {
        $publicacion = Publicacion::findOrFail($id);

        // Opción 1: borrado lógico (recomendado)
        $publicacion->estado_id = 12; // estado "eliminada"
        $publicacion->save();


        return redirect()->route('admin.publicaciones.index')
            ->with('success', 'Publicación eliminada');
    }
}

