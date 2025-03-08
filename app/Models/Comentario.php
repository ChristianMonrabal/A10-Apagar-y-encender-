<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function incidencia() {
        return $this->belongsTo(Incidencia::class);
    }

    public function cliente() {
        return $this->belongsTo(Usuario::class);
    }
    
    public function tecnico() {
        return $this->belongsTo(Usuario::class);
    }
}
