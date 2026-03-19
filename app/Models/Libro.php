<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table='libros';

    protected $primaryKey='id';
    protected $fillable = [
        'titulo',
        'autor',
        'asignatura_id',
        'curso_id',
        'editorial',
        'ISBN'
    ];
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

        public function asignatura()
    {
        return $this->belongsTo(Asignatura::class, 'asignatura_id');
    }

            public function centros()
    {
        return $this->hasMany(CentroLibro::class, 'libro_id');
    }

    public function index()
    {
        $libros=Libro::with('curso','asignatura')->get();

        return view('libros.index', compact('libros'));
    }
}
