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
        return $this->belongsTo(Subcategoria::class, 'subcategorias_id');
    }

    public function estado() {
        return $this->belongsTo(Estado::class, 'estados_id');
    }

    public function prioridad() {
        return $this->belongsTo(Prioridad::class, 'prioridades_id');
    }

    public function comentario() {
        return $this->hasMany(Comentario::class, 'incidencias_id');
    }

    public function imagen() {
        return $this->hasMany(Imagen::class, 'incidencias_id');
    }

}
