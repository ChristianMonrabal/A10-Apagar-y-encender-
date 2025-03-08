<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    
    public function cliente() {
        return $this->belongsTo(Usuario::class);
    }
    
    public function tecnico() {
        return $this->belongsTo(Usuario::class);
    }

    public function gestor() {
        return $this->belongsTo(Usuario::class);
    }

    public function subcategoria() {
        return $this->belongsTo(Subcategoria::class);
    }

    public function estado() {
        return $this->belongsTo(Estado::class);
    }

    public function prioridad() {
        return $this->belongsTo(Prioridad::class);
    }


}
