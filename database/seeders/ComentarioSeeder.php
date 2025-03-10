<?php

namespace Database\Seeders;

use App\Models\Comentario;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();
        
        Comentario::create([
            'incidencias_id' => 1,
            'cliente_id' => 1,
            'tecnico_id' => 10,
            'texto' => 'Hola buenas, sigo teniendo problemas con el Google Meet.',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Comentario::create([
            'incidencias_id' => 2,
            'cliente_id' => 2,
            'tecnico_id' => 8,
            'texto' => 'Hola buenas, sigo teniendo líneas lilas en la pantalla.',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        Comentario::create([
            'incidencias_id' => 3,
            'cliente_id' => 3,
            'tecnico_id' => 12,
            'texto' => 'Hola buenas, se sigue sin ver la pantalla.',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
    }
}
