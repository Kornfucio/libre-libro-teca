<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    protected $table='etapas';

    protected $primaryKey='id';

    protected $fillable= [
        'nombre_etapa'
    ];

    public function curso()
    {
        return $this->hasMany(Curso::class, 'etapa_id');
    }
}
