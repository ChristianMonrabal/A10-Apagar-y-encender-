<?php

namespace Database\Seeders;

use App\Models\Incidencia;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        Incidencia::create([
            'titulo' => 'El Google Meet no va',
            'cliente_id' => 1,
            'tecnico_id' => 10,
            'gestor_id' => 6,
            'subcategorias_id' => 3,
            'descripcion' => 'No se me abre el Google Meet y me dice que mi cuenta no existe.',
            'estados_id' => 1,
            'prioridades_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Incidencia::create([
            'titulo' => 'La pantalla se ve lila con rayas negras',
            'cliente_id' => 2,
            'tecnico_id' => 8,
            'gestor_id' => 5,
            'subcategorias_id' => 4,
            'descripcion' => 'Hace dos días que cada vez que enciendo la pantalla sale así. Ya no se que hacer.',
            'estados_id' => 2,
            'prioridades_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Incidencia::create([
            'titulo' => 'No veo la pantalla',
            'cliente_id' => 3,
            'tecnico_id' => 12,
            'gestor_id' => 7,
            'subcategorias_id' => 7,
            'descripcion' => 'Le estoy dando todo el rato al botón de encender, y no se enciende.',
            'estados_id' => 3,
            'prioridades_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Incidencia::create([
            'titulo' => 'Problema de conexión',
            'cliente_id' => 4,
            'tecnico_id' => 9,
            'gestor_id' => 5,
            'subcategorias_id' => 6,
            'descripcion' => 'El ratón bluetooth no se conecta.',
            'estados_id' => 4,
            'prioridades_id' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Incidencia::create([
            'titulo' => 'Aplicación hace que no se vea el proyector',
            'cliente_id' => 1,
            'tecnico_id' => 11,
            'gestor_id' => 5,
            'subcategorias_id' => 8,
            'descripcion' => 'Desde que abro la aplicación del libro digital, se empieza a ver la pantalla difusa.',
            'estados_id' => 5,
            'prioridades_id' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
