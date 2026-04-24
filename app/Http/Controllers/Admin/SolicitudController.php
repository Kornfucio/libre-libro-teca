<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolicitudIntercambio;

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

        // Solo permitir finalizar si está aceptada (ajusta si quieres)
        if ($solicitud->estado_id != 9) {
            return redirect()->back()->with('error', 'Solo se pueden finalizar solicitudes aceptadas');
        }

        $solicitud->estado_id = 15; // finalizada
        $solicitud->save();

        return redirect()->back()->with('success', 'Solicitud finalizada correctamente.');
    }
}
