<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incidencia_id')->constrained('incidencias');
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->text('texto');
            $table->timestamps(0); // created_at, updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
    
};
