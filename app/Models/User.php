<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $table='users';

    protected $primaryKey='id';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'telefono',
        'rol',
        'estado_id',
        'centro_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function centro()
    {
        return $this->belongsTo(CentroEducativo::class, 'centro_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class, 'usuario_id');
    }

    public function solicitudes()
    {
        return $this->hasMany(SolicitudIntercambio::class, 'usuario_id');
    }

}
