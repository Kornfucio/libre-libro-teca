<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    protected $table='asignaturas';

    protected $primaryKey='id';

    protected $fillable= [
        'asignatura'
    ];

    public function libros()
    {
        return $this->hasMany(Libro::class, 'asignatura_id');
    }
}
