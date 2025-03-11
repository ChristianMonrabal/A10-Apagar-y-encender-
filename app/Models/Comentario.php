<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    // Permite la asignación masiva de estos campos
    protected $fillable = [
        'incidencias_id',
        'cliente_id',  // Se usará para el comentario del cliente
        'tecnico_id',  // Opcional, si se asigna un técnico
        'texto'
    ];

    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class, 'incidencias_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'cliente_id');
    }
    
    public function tecnico()
    {
        return $this->belongsTo(Usuario::class, 'tecnico_id');
    }
}
