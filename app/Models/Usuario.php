<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function rol() {
        return $this->belongsTo(Rol::class);
    }

    public function sede() {
        return $this->belongsTo(Sede::class);
    }
    
    public function tecnico() {
        return $this->belongsTo(Usuario::class);
    }

    public function gestor() {
        return $this->belongsTo(Usuario::class);
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
