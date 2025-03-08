<?php

namespace Database\Seeders;

use App\Models\Rol;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();

        Rol::create([
            'nombre' => 'cliente',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Rol::create([
            'nombre' => 'administrador',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Rol::create([
            'nombre' => 'gestor de equipo',
            'created_at' => $now,
            'updated_at' => $now,
        ]);   

        Rol::create([
            'nombre' => 'tecnico de mantenimiento',
            'created_at' => $now,
            'updated_at' => $now,
        ]);   
    }
}
