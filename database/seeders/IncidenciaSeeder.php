<?php

namespace Database\Seeders;

use App\Models\Incidencia;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class IncidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Ejemplos anteriores con tecnico_id = 4
        Incidencia::create([
            'titulo' => 'El Google Meet no va',
            'cliente_id' => 1,
            'tecnico_id' => 4,
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
            'tecnico_id' => 4,
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
            'tecnico_id' => 4,
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
            'tecnico_id' => 4,
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
            'tecnico_id' => 4,
            'gestor_id' => 5,
            'subcategorias_id' => 8,
            'descripcion' => 'Desde que abro la aplicación del libro digital, se empieza a ver la pantalla difusa.',
            'estados_id' => 5,
            'prioridades_id' => 5,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Nuevos ejemplos con distintos tecnico_id (valores entre 1 y 4)
        Incidencia::create([
            'titulo' => 'Error al actualizar software',
            'cliente_id' => 5,
            'tecnico_id' => 1, // Técnico 1
            'gestor_id' => 4,
            'subcategorias_id' => 2,
            'descripcion' => 'Al intentar actualizar el software, se produce un error inesperado.',
            'estados_id' => 2,
            'prioridades_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Incidencia::create([
            'titulo' => 'Problema con conexión VPN',
            'cliente_id' => 6,
            'tecnico_id' => 2, // Técnico 2
            'gestor_id' => 3,
            'subcategorias_id' => 1,
            'descripcion' => 'El usuario no logra conectarse a la VPN de la empresa.',
            'estados_id' => 1,
            'prioridades_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Incidencia::create([
            'titulo' => 'Pantalla azul al arrancar',
            'cliente_id' => 7,
            'tecnico_id' => 3, // Técnico 3
            'gestor_id' => 8,
            'subcategorias_id' => 4,
            'descripcion' => 'El equipo muestra una pantalla azul durante el arranque.',
            'estados_id' => 3,
            'prioridades_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Incidencia::create([
            'titulo' => 'Error de impresión en red',
            'cliente_id' => 8,
            'tecnico_id' => 4, // Técnico 4
            'gestor_id' => 5,
            'subcategorias_id' => 3,
            'descripcion' => 'No se pueden imprimir documentos a través de la red.',
            'estados_id' => 2,
            'prioridades_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        Incidencia::create([
            'titulo' => 'Intermitencia en conexión de red',
            'cliente_id' => 9,
            'tecnico_id' => 1, // Técnico 1
            'gestor_id' => 6,
            'subcategorias_id' => 2,
            'descripcion' => 'La conexión a internet es intermitente y se cae frecuentemente.',
            'estados_id' => 4,
            'prioridades_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
