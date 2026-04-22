<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CentroEducativo;
use App\Models\Estado;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
{
    $query=User::query();
        //Filtro por rol
        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }
        //Filtro por centro
        if ($request->filled('centro_id')) {
            $query->where('centro_id', $request->centro_id);
        }

        //Filtro por estado
        if ($request->filled('estado_id')) {
            $query->where('estado_id', $request->estado_id);
        }

        $usuarios = $query->with(['centro', 'estado'])->get();

        //Para los seclects de filtro, necesito la lista completa de centros y estados para mostrar las opciones
        $centros=CentroEducativo::all();
        $estados=Estado::whereIn('id', [1, 2, 4, 14])->get(); //Solo muestro los estados relevantes para los usuarios (activo, pendiente, bloqueado, eliminado)
    return view('admin.users.index', compact('usuarios', 'centros', 'estados'));
}




public function edit(User $user)
{
    $centros=CentroEducativo::all();
    $estados=Estado::whereIn('id', [1, 2, 4, 14])->get(); //Solo muestro los estados relevantes para los usuarios (activo, pendiente, bloqueado, eliminado)
    return view('admin.users.edit', compact('user', 'centros', 'estados'));
}

public function update(Request $request, User $user)
{
    // Validación básica
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email',
        'rol' => 'required|in:usuario,admin',
        'centro_id' => 'nullable|exists:centros_educativos,id',
        'estado_id' => 'required|exists:estados,id',
    ]);

    // Actualizar datos
    $user->update([
        'nombre' => $request->nombre,
        'email' => $request->email,
        'rol' => $request->rol,
        'centro_id' => $request->centro_id,
        'estado_id' => $request->estado_id,
    ]);

    // Redirección
    return redirect()->route('admin.users.index')
        ->with('success', 'Usuario actualizado correctamente');
}

public function destroy(User $user)
{
    $user->estado_id=14; //El estado 14 representa eliminado
    $user->save();
    return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado exitosamente.');
}

public function show(User $user)
{
    $user->load('centro', 'estado'); //Cargo las relaciones para mostrar el nombre del centro y estado en la vista de detalle

    return view('admin.users.show', compact('user'));
}

public function block(User $user)
{
    $user->estado_id=4; //El estado 4 representa bloqueado
    $user->save();
    return redirect()->route('admin.users.index')->with('success', 'Usuario bloqueado exitosamente.');
}
}
