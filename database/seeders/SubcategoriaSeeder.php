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
            'nombre' => 'Aplicació gestió administrativa',
            'categorias_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'Accés remot',
            'categorias_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'Aplicació de videoconferència',
            'categorias_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'Imatge de projector defectuosa',
            'categorias_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'Problema amb el teclat',
            'categorias_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'El ratolí no funciona',
            'categorias_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => "Monitor no s'encén",
            'categorias_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Subcategoria::create([
            'nombre' => 'Imatge de projector defectuosa',
            'categorias_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
