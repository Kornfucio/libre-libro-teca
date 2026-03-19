<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table='estados';

    protected $primaryKey='id';

    protected $fillable= [
        'nombre_estado'
    ];

    public function centroEducativo()
    {
        return $this->hasMany(CentroEducativo::class, 'estado_id');
    }

    public function user()
   {
        return $this->hasMany(User::class, 'estado_id');
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class, 'estado_id');
    }

    public function solicitudes()
    {
        return $this->hasMany(SolicitudIntercambio::class, 'estado_id');
    }

    public function intercambios()
    {
        return $this->hasMany(Intercambio::class, 'estado_id');
    }
}
