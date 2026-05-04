<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroLibro extends Model
{
    protected $table='centros_libro';
    protected $primaryKey='id';
    protected $fillable= [
        'centro_id',
        'libro_id',
        'anyo_academico'
    ];

    public function centro()
    {
        return $this->belongsTo(CentroEducativo::class, 'centro_id');
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class, 'centros_libro_id');
    }
}
