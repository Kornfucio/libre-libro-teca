<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table='cursos';

    protected $primaryKey='id';

    protected $fillable=
    [
        'nombre_curso',
        'etapa_id'
    ];

    public function libros()
    {
        return $this->hasMany(Libro::class, 'curso_id');
    }

    public function etapa()
    {
        return $this->belongsTo(Etapa::class, 'etapa_id');
    }
}
