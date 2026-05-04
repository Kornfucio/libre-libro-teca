<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroEducativo extends Model
{
    protected $table='centros_educativos';

    protected $primaryKey= 'id';

    protected $fillable = [
        'nombre_centro',
        'cif_centro',
        'direccion',
        'localidad',
        'provincia',
        'telefono',
        'email',
        'estado_id',
    ];

    public function usuarios()
    {
        return $this->hasMany(User::class, 'centro_id');
    }

    public function centroLibro()
    {
        return $this->hasMany(CentroLibro::class, 'centro_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
}
