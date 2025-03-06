<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::create('sedes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->timestamps(0);
    });
}

public function down()
{
    Schema::dropIfExists('sedes');
}

};
