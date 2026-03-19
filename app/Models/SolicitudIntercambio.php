<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudIntercambio extends Model
{
    protected $table='solicitudes_intercambio';

    protected $primaryKey='id';

    protected $fillable= [
        'publicacion_id',
        'usuario_id',
        'mensaje',
        'estado_id',
        'fecha_solicitud',
        'fecha_respuesta'

    ];

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'publicacion_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function intercambio()
    {
        return $this->hasOne(Intercambio::class, 'solicitud_id');
    }
}
