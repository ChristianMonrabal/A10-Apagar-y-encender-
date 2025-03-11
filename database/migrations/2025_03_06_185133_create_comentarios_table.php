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
            $table->foreignId('incidencias_id')->constrained('incidencias');
            $table->foreignId('cliente_id')->constrained('usuarios');
            $table->foreignId('tecnico_id')->nullable()->constrained('usuarios');
            $table->text('texto');
            $table->timestamps(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
    
};
