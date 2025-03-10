<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Categoria::create([
            'nombre' => 'Software',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Categoria::create([
            'nombre' => 'Hardware',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
