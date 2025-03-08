<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    
    public function incidencia() {
        return $this->hasOne(Incidencia::class);
    }
}
