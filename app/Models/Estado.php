<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public function incidencia() {
        return $this->hasOne(Incidencia::class);
    }
}
