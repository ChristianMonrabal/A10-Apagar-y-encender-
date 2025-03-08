<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre', 'email', 'password', 'sede_id', 'rol_id', 'activo',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relación con la tabla sedes
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    // Relación con la tabla roles
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}
