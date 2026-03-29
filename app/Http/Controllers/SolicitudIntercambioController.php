<?php

namespace App\Http\Controllers;

use App\Models\SolicitudIntercambio;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class SolicitudIntercambioController extends Controller
{
    /**
     * Mostrar solicitudes (enviadas y recibidas)
     */
    public function index()
    {
        // Solicitudes que YO he enviado
        $enviadas = SolicitudIntercambio::where('usuario_id', auth()->id())
            ->where('estado_id', 8)
            ->with(['publicacion.centroLibro.libro', 'publicacion.usuario', 'estado'])
            ->get();

        // Solicitudes que YO he recibido (sobre mis publicaciones)
        $recibidas = SolicitudIntercambio::whereHas('publicacion', function ($query) {
            $query->where('usuario_id', auth()->id());
        })
            ->where('estado_id', 8) // SOLO pendientes
            ->with(['publicacion.centroLibro.libro', 'usuario', 'estado'])
         ->get();

        return view('solicitudes.index', compact('enviadas', 'recibidas'));
    }

    /**
     * Crear una solicitud
     */
    public function store(Publicacion $publicacion)
    {
        // Evitar solicitar tu propio libro
        if ($publicacion->usuario_id === auth()->id()) {
            return back()->with('error', 'No puedes solicitar tu propia publicación');
        }

        // Crear solicitud
        SolicitudIntercambio::create([
            'usuario_id' => auth()->id(),
            'publicacion_id' => $publicacion->id,
            'estado_id' => 8 // pendiente
        ]);

        return back()->with('success', 'Solicitud enviada correctamente');
    }

    /**
     * Aceptar solicitud
     */
    public function aceptar($id)
{
    $solicitud = SolicitudIntercambio::findOrFail($id);

    if ($solicitud->publicacion->usuario_id !== auth()->id()) {
        abort(403);
    }

    // Aceptar la seleccionada
    $solicitud->estado_id = 9;
    $solicitud->save();

    // Rechazar el resto automáticamente
    SolicitudIntercambio::where('publicacion_id', $solicitud->publicacion_id)
        ->where('id', '!=', $solicitud->id)
        ->update(['estado_id' => 10]);

    return back()->with('success', 'Solicitud aceptada');
}
    /**
     * Rechazar solicitud
     */
    public function rechazar($id)
    {
        $solicitud = SolicitudIntercambio::findOrFail($id);

        // Seguridad
        if ($solicitud->publicacion->usuario_id !== auth()->id()) {
            abort(403);
        }

        $solicitud->estado_id = 10; // rechazada
        $solicitud->save();

        return back()->with('success', 'Solicitud rechazada');
    }
}
