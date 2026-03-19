<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intercambio extends Model
{
    protected $table='intercambios';

    protected $primaryKey='id';

    protected $fillable= [
        'solicitud_id',
        'fecha_confirmacion',
        'estado_id'
    ];

    public function solicitud()
    {
        return $this->belongsTo(SolicitudIntercambio::class, 'solicitud_id');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
