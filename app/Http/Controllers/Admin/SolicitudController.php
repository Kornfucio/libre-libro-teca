<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolicitudIntercambio;


class SolicitudController extends Controller
{

    //Mostrar todas las solicitudes de intercambio del sistema (para administración)
    public function index()
{
    $solicitudes = SolicitudIntercambio::with(['publicacion.centroLibro.libro', 'publicacion.usuario', 'usuario', 'estado'])->paginate(10);

    //Filtro por estado (opcional)
    if (request()->has('estado')) {
        $solicitudes = SolicitudIntercambio::with(['publicacion.centroLibro.libro', 'publicacion.usuario', 'usuario', 'estado'])
            ->where('estado_id', request('estado'))
            ->paginate(10);
    }

    if (request()->has('usuario')) {
        $solicitudes = SolicitudIntercambio::with(['publicacion.centroLibro.libro', 'publicacion.usuario', 'usuario', 'estado'])
            ->whereHas('usuario', function ($query) {
                $query->where('name', 'like', '%' . request('usuario') . '%');
            })
            ->paginate(10);
    }

    return view('admin.solicitudes.index', compact('solicitudes'));
}

    //Ver detalles de una solicitud específica (para administración)
    public function show($id)
    {
        $solicitud = SolicitudIntercambio::with([
            'publicacion.centroLibro.libro',
            'publicacion.usuario',
            'usuario',
            'estado'
            ])->findOrFail($id);

        return view('admin.solicitudes.show', compact('solicitud'));
    }


    //Cancelar una solicitud (para administración)
    public function cancelar($id)
    {
        $solicitud = SolicitudIntercambio::findOrFail($id);

        $solicitud->estado_id = 13; //Estado de la solicitud pasa a cancelada
        $solicitud->save();

        return redirect()->back()->with('success', 'Solicitud cancelada correctamente.');
    }

    //Finalizar una solicitud (para administración)

    public function finalizar($id)
    {
        $solicitud = SolicitudIntercambio::findOrFail($id);

        $solicitud->estado_id = 15; //Estado de la solicitud pasa a finalizada
        $solicitud->save();

        return redirect()->back()->with('success', 'Solicitud finalizada correctamente.');
    }



}
