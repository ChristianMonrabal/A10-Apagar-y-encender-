<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function incidencia_cliente() {
        return $this->belongsTo(Usuario::class);
    }
    
    public function incidencia_tecnico() {
        return $this->belongsTo(Usuario::class);
    }
}
