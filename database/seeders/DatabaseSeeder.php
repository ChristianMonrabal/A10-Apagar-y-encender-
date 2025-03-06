<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            SedeSeeder::class,
            RolSeeder::class,
            UsuarioSeeder::class,
            CategoriaSeeder::class,
            SubcategoriaSeeder::class,
            EstadoSeeder::class,
            PrioridadSeeder::class,
            IncidenciaSeeder::class,
            ComentarioSeeder::class,
            ImagenSeeder::class,
        ]);
    }
}
