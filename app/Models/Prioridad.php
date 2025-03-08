<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    protected $table = 'prioridades';

    public function incidencia() {
        return $this->hasOne(Incidencia::class);
    }
}
