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

        Incidencia::create([
            'titulo'         => 'El Google Meet no va',
            'cliente_id'     => 1,      // Usuario con rol de cliente
            'tecnico_id'     => 2,      // Usuario con rol de técnico
            'gestor_id'      => 3,      // Usuario con rol de gestor
            'subcategorias_id' => 1,    // Ej.: "Videoconferencias"
            'descripcion'    => 'No se abre Google Meet y me dice que mi cuenta no existe.',
            'estados_id'     => 1,      // Ej.: "Abierta"
            'prioridades_id' => 1,      // Ej.: "Baja"
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        Incidencia::create([
            'titulo'         => 'La pantalla se ve lila con rayas negras',
            'cliente_id'     => 2,
            'tecnico_id'     => 4,
            'gestor_id'      => 5,
            'subcategorias_id' => 2,    // Ej.: "Hardware general"
            'descripcion'    => 'Aparecen rayas negras y un tono lila al encender.',
            'estados_id'     => 2,      // Ej.: "Asignada"
            'prioridades_id' => 2,      // Ej.: "Media"
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        Incidencia::create([
            'titulo'         => 'Error al actualizar software',
            'cliente_id'     => 3,
            'tecnico_id'     => 1,
            'gestor_id'      => 4,
            'subcategorias_id' => 3,    // Ej.: "Actualizaciones"
            'descripcion'    => 'Al intentar actualizar, el sistema lanza un error inesperado.',
            'estados_id'     => 3,      // Ej.: "En trabajo"
            'prioridades_id' => 2,      // Ej.: "Media"
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        Incidencia::create([
            'titulo'         => 'Problema con conexión VPN',
            'cliente_id'     => 4,
            'tecnico_id'     => 2,
            'gestor_id'      => 6,
            'subcategorias_id' => 1,    // Ej.: "Red / VPN"
            'descripcion'    => 'El usuario no logra conectarse a la VPN de la empresa.',
            'estados_id'     => 2,      // "Asignada"
            'prioridades_id' => 3,      // "Alta"
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        Incidencia::create([
            'titulo'         => 'Pantalla azul al arrancar',
            'cliente_id'     => 5,
            'tecnico_id'     => 3,
            'gestor_id'      => 7,
            'subcategorias_id' => 2,    // "Hardware general"
            'descripcion'    => 'El equipo muestra una pantalla azul durante el arranque.',
            'estados_id'     => 3,      // "En trabajo"
            'prioridades_id' => 1,      // "Baja"
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        Incidencia::create([
            'titulo'         => 'Error de impresión en red',
            'cliente_id'     => 6,
            'tecnico_id'     => 4,
            'gestor_id'      => 8,
            'subcategorias_id' => 3,    // "Actualizaciones" o "Impresoras" (ajusta según tu catálogo)
            'descripcion'    => 'No se pueden imprimir documentos a través de la red.',
            'estados_id'     => 2,      // "Asignada"
            'prioridades_id' => 4,      // "Crítica"
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        Incidencia::create([
            'titulo'         => 'Ratón Bluetooth no se conecta',
            'cliente_id'     => 1,
            'tecnico_id'     => 2,
            'gestor_id'      => 5,
            'subcategorias_id' => 6,    // Por ejemplo, "Periféricos"
            'descripcion'    => 'El ratón inalámbrico deja de responder al cabo de 5 minutos.',
            'estados_id'     => 1,      // "Abierta"
            'prioridades_id' => 3,      // "Alta"
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        Incidencia::create([
            'titulo'         => 'Aplicación no proyecta correctamente',
            'cliente_id'     => 2,
            'tecnico_id'     => 1,
            'gestor_id'      => 4,
            'subcategorias_id' => 8,    // Ej.: "Software educativo" (ajusta a tu catálogo)
            'descripcion'    => 'Al abrir la aplicación del libro digital, la proyección se ve distorsionada.',
            'estados_id'     => 4,      // "Resuelta"
            'prioridades_id' => 5,      // "Muy urgente" o según tu escala
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        Incidencia::create([
            'titulo'         => 'Cascos no funcionan',
            'cliente_id'     => 1,
            'tecnico_id'     => 3,
            'gestor_id'      => 5,
            'subcategorias_id' => 6,    // "Periféricos"
            'descripcion'    => 'Los cascos USB no emiten audio en ningún puerto.',
            'estados_id'     => 3,      // "En trabajo"
            'prioridades_id' => 5,      // "Muy urgente" u otro valor
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);

        Incidencia::create([
            'titulo'         => 'Intermitencia en conexión de red',
            'cliente_id'     => 3,
            'tecnico_id'     => 4,
            'gestor_id'      => 6,
            'subcategorias_id' => 2,    // "Hardware general" o "Red"
            'descripcion'    => 'La conexión a internet es intermitente y se cae con frecuencia.',
            'estados_id'     => 5,      // "Cerrada" o la que aplique
            'prioridades_id' => 4,      // "Crítica"
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
    }
}
