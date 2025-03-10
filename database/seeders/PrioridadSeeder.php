<?php

namespace Database\Seeders;

use App\Models\Prioridad;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioridadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Prioridad::create([
            'nivel' => 'Muy baja',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Prioridad::create([
            'nivel' => 'Baja',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Prioridad::create([
            'nivel' => 'Media',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Prioridad::create([
            'nivel' => 'Alta',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Prioridad::create([
            'nivel' => 'Urgente',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
