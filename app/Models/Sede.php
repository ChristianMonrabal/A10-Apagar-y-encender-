<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'sedes';
    
    public function usuario()
    {
        return $this->hasMany(Usuario::class);
    }
}
