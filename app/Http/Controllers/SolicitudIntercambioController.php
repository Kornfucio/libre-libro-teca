<?php

namespace App\Http\Controllers;

use App\Models\SolicitudIntercambio;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolicitudAceptada;
use App\Mail\SolicitudRechazada;

class SolicitudIntercambioController extends Controller
{
    /**
     * ESTE CONTROLOR GESTIONA LAS SOLICITUDES DE INTERCAMBIO:
     * - index(): Muestra las solicitudes enviadas y recibidas
     * - store(): Crea una nueva solicitud
     * - aceptar(): Acepta una solicitud recibida
     * - rechazar(): Rechaza una solicitud recibida
     * - Solo el propietario de la publicación puede aceptar o rechazar solicitudes
     * - Las solicitudes enviadas se muestran en pestañas: Pendientes, Aceptadas, Rechazadas
     * - Las solicitudes recibidas SOLO se muestran las pendientes (para acción inmediata)
     */


    /**
     * Mostrar solicitudes (enviadas y recibidas)
     */
    public function index()
    {
        // Solicitudes que YO he enviado (HISTÓRICO COMPLETO)
        $enviadas = SolicitudIntercambio::where('usuario_id', auth()->id())
            ->with(['publicacion.centroLibro.libro', 'publicacion.usuario', 'estado'])
            ->get();

       // Solicitudes recibidas pendientes (paginadas)
        $recibidas = SolicitudIntercambio::whereHas('publicacion', function ($query) {
                $query->where('usuario_id', auth()->id());
            })
            ->where('estado_id', 8)
            ->with(['publicacion.centroLibro.libro', 'usuario', 'estado'])
            ->paginate(10, ['*'], 'pendientes_page');
        // Histórico de solicitudes recibidas (paginado)
        $recibidasHistorico = SolicitudIntercambio::whereHas('publicacion', function ($query) {
                $query->where('usuario_id', auth()->id());
            })
            ->whereIn('estado_id', [9,10])
            ->with(['publicacion.centroLibro.libro', 'usuario', 'estado'])
            ->paginate(20, ['*'], 'historico_page');

        // Indicadores
        $aceptadasCount = $enviadas->where('estado_id', 9)->count();

        // Separación por pestañas
        $pendientes = $enviadas->where('estado_id', 8);
        $aceptadas = $enviadas->where('estado_id', 9);
        $rechazadas = $enviadas->where('estado_id', 10);

        return view('solicitudes.index', compact(
            'enviadas',
            'recibidas',
            'recibidasHistorico',
            'aceptadasCount',
            'pendientes',
            'aceptadas',
            'rechazadas'
        ));
        }

    /**
     * Crear una solicitud
     */
    public function store(Publicacion $publicacion)
    {
        if ($publicacion->usuario_id === auth()->id()) {
            return back()->with('error', 'No puedes solicitar tu propia publicación');
        }

        SolicitudIntercambio::create([
            'usuario_id' => auth()->id(),
            'publicacion_id' => $publicacion->id,
            'estado_id' => 8
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

        $solicitud->estado_id = 9;
        $solicitud->save();

        // CAMBIAR ESTADO DE LA PUBLICACIÓN
        $publicacion = $solicitud->publicacion;
        $publicacion->estado_id = 5; // Solicitud que pasa a aceptada, la publicación pasa a despublicado para que se comprometa el intercambio y no pueda solicitarla nadie más
        $publicacion->save();

        SolicitudIntercambio::where('publicacion_id', $solicitud->publicacion_id)
            ->where('id', '!=', $solicitud->id)
            ->update(['estado_id' => 10]);

        Mail::to($solicitud->usuario->email) //Mensajería para informar al solicitante de que su solicitud ha sido aceptada
         ->send(new SolicitudAceptada());

        return back()->with('success', 'Solicitud aceptada');
    }

    /**
     * Rechazar solicitud
     */
    public function rechazar($id)
    {
        $solicitud = SolicitudIntercambio::findOrFail($id);

        if ($solicitud->publicacion->usuario_id !== auth()->id()) {
            abort(403);
        }

        $solicitud->estado_id = 10;
        $solicitud->save();

        Mail::to($solicitud->usuario->email) //Mensajería para informar al solicitante de que su solicitud ha sido rechazada
         ->send(new SolicitudRechazada());

        return back()->with('error', 'Solicitud rechazada');
    }

    public function cancelar($id) //Método para que el solicitante pueda cancelar una solicitud pendiente
    {
        $solicitud = SolicitudIntercambio::findOrFail($id);

        //Solo el usuario que envió la solicitud puede cancelarla
        if ($solicitud->usuario_id !== auth()->id()) {
            abort(403);
        }
        if ($solicitud->estado_id != 8) { //Solo se pueden cancelar las solicitudes pendientes
            return back()->with('error', 'Solo puedes cancelar solicitudes pendientes');
        }

        $solicitud->estado_id = 13; // Estado de solicitud cancelada
        $solicitud->save();

        return back()->with('success', 'Solicitud cancelada');
    }
}
