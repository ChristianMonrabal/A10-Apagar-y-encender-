<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('sedes_id')->constrained('sedes');
            $table->foreignId('roles_id')->constrained('roles');
            $table->boolean('activo')->default(true);
            $table->timestamps(0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
    
};
