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

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sedes_id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'roles_id');
    }

    public function incidencia_cliente() {
        return $this->hasOne(Incidencia::class, 'cliente_id');
    }
    
    public function incidencia_tecnico() {
        return $this->hasOne(Incidencia::class, 'tecnico_id');
    }
    
    public function incidencia_gestor() {
        return $this->hasOne(Incidencia::class, 'gestor_id');
    }

    public function comentario_cliente() {
        return $this->hasOne(Incidencia::class, 'cliente_id');
    }
    
    public function comentario_tecnico() {
        return $this->hasOne(Incidencia::class, 'tecnico_id');
    }
}
