<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table='publicaciones';

    protected $primaryKey='id';

    protected $fillable= [
        'usuario_id',
        'centros_libro_id',
        'descripcion',
        'estado_id',
        'fecha_publicacion'
    ];

    public function usuario()
     {
        return $this->belongsTo(User::class, 'usuario_id');
     }

    public function centroLibro()
    {
        return $this->belongsTo(CentroLibro::class, 'centros_libro_id');
    }

    public function solicitudes()
    {
        return $this->hasMany(SolicitudIntercambio::class, 'publicacion_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
