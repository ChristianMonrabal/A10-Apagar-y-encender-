<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $fillable = ['ruta'];
    protected $table = 'imagenes';

    public function incidencia() {
        return $this->belongsTo(Incidencia::class);
    }
}
