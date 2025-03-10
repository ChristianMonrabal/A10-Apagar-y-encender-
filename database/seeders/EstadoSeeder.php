<?php

namespace Database\Seeders;

use App\Models\Estado;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Estado::create([
            'nombre' => 'Sin asignar',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Estado::create([
            'nombre' => 'Asignada',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Estado::create([
            'nombre' => 'En trabajo',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Estado::create([
            'nombre' => 'Resuelta',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Estado::create([
            'nombre' => 'Cerrada',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
