<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroEducativo extends Model
{
    protected $table='centros_educativos';

    protected $primaryKey= 'id';

    protected $fillable = [
        'nombre',
        'codigo',
        'direccion',
        'localidad',
        'telefono',
        'email',
        'estado'
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
        return $this->belongsTo(estado::class, 'estado_id');
    }
}
