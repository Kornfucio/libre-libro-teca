<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolicitudIntercambio;
use App\Models\Intercambio;
use Illuminate\Support\Facades\DB;

class SolicitudController extends Controller
{
    // Mostrar solicitudes (admin)
    public function index(Request $request)
    {
        // Creamos la query base
        $query = SolicitudIntercambio::with([
            'publicacion.centroLibro.libro',
            'publicacion.centroLibro.centro',
            'publicacion.usuario',
            'usuario',
            'estado'
        ]);

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado_id', $request->estado);
        }

        // Filtro por usuario solicitante
        if ($request->filled('usuario')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->usuario . '%');
            });
        }

        // Ejecutamos la consulta
        $solicitudes = $query->latest()->paginate(10);

        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    // Ver detalle
    public function show($id)
    {
        $solicitud = SolicitudIntercambio::with([
            'publicacion.centroLibro.libro',
            'publicacion.centroLibro.centro',
            'publicacion.usuario',
            'usuario',
            'estado'
        ])->findOrFail($id);

        return view('admin.solicitudes.show', compact('solicitud'));
    }

    // Cancelar solicitud
    public function cancelar($id)
    {
        $solicitud = SolicitudIntercambio::findOrFail($id);

        // Solo permitir cancelar si está pendiente
        if ($solicitud->estado_id != 8) {
            return redirect()->back()->with('error', 'Solo se pueden cancelar solicitudes pendientes');
        }

        $solicitud->estado_id = 13; // cancelada
        $solicitud->save();

        return redirect()->back()->with('success', 'Solicitud cancelada correctamente.');
    }

    // Finalizar solicitud
public function finalizar($id)
{
    $solicitud = SolicitudIntercambio::findOrFail($id);

    // Solo permitir si está aceptada
    if ($solicitud->estado_id != 9) {
        return back()->with('error', 'Solo se pueden finalizar solicitudes aceptadas');
    }

    DB::beginTransaction();

    try {

        // Evitar duplicados
        if (Intercambio::where('solicitud_id', $solicitud->id)->exists()) {
            DB::rollBack();
            return back()->with('error', 'Este intercambio ya fue registrado');
        }

        // Crear intercambio
        Intercambio::create([
            'solicitud_id' => $solicitud->id,
            'fecha_confirmacion' => now(),
            'estado_id' => 15, // finzalizado
        ]);

        // Cambiar estado de la solicitud
        $solicitud->estado_id = 11; // completada
        $solicitud->save();

        DB::commit();

        return back()->with('success', 'Intercambio finalizado correctamente');

    } catch (\Exception $e) {

        DB::rollBack();
        return back()->with('error', 'Error al finalizar el intercambio');
    }
}
}
