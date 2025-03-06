<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->foreignId('cliente_id')->constrained('usuarios');
            $table->foreignId('tecnico_id')->nullable()->constrained('usuarios');
            $table->foreignId('gestor_id')->nullable()->constrained('usuarios');
            $table->foreignId('subcategoria_id')->constrained('subcategorias');
            $table->text('descripcion');
            $table->foreignId('estado_id')->constrained('estados');
            $table->foreignId('prioridad_id')->nullable()->constrained('prioridades');
            $table->timestamps(0); // created_at, updated_at
            $table->timestamp('fecha_resolucion')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
    
};
