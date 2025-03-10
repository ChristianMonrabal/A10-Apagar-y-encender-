<?php

namespace Database\Seeders;

use App\Models\Imagen;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Imagen::create([
            'incidencias_id' => 1,
            'ruta' => 'imagen1.jpg',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Imagen::create([
            'incidencias_id' => 2,
            'ruta' => 'imagen2.jpg',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Imagen::create([
            'incidencias_id' => 3,
            'ruta' => 'imagen3.jpg',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Imagen::create([
            'incidencias_id' => 4,
            'ruta' => 'imagen4.jpg',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Imagen::create([
            'incidencias_id' => 5,
            'ruta' => 'imagen5.jpg',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
