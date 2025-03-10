<?php

namespace Database\Seeders;

use App\Models\Subcategoria;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        Subcategoria::create([
            'nombre' => 'Aplicación gestión administrativa',
            'categorias_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'Acceso remoto',
            'categorias_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'Aplicación de videoconferencia',
            'categorias_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'Imagen del proyector defectuosa',
            'categorias_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'Problema con el teclado',
            'categorias_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'El ratón no funciona',
            'categorias_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'El monitor no enciende',
            'categorias_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'Imagen del proyector defectuosa',
            'categorias_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
