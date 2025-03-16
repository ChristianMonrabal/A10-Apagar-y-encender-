<?php

namespace App\Http\Controllers;


use App\Models\Prioridad;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;
use App\Models\Estado;





class TecnicoController extends Controller
{
    // public function dashboard()
    // {
    //     return view('tecnico.index');
    // }


    public function tecnicoIndex(Request $request)
{
    // Obtener el usuario autenticado (por ejemplo, el técnico)
    $user = Auth::user();

    // Iniciar la consulta filtrando por técnico
    $query = Incidencia::where('tecnico_id', $user->id)
                ->with(['cliente', 'tecnico', 'estado', 'prioridad']);

    // Filtro de búsqueda en título y descripción
    if ($search = $request->input('search')) {
        $query->where(function($q) use ($search) {
            $q->where('titulo', 'LIKE', "%{$search}%")
              ->orWhere('descripcion', 'LIKE', "%{$search}%");
        });
    }

    // Filtro por estado (si se selecciona uno)
    if ($estado = $request->input('estado')) {
        $query->whereHas('estado', function($q) use ($estado) {
            $q->where('id', $estado);
        });
    }

    // (Filtro por usuario eliminado)

    // Filtro por prioridad (si se selecciona una)
    if ($prioridad = $request->input('prioridad')) {
        $query->whereHas('prioridad', function($q) use ($prioridad) {
            $q->where('id', $prioridad);
        });
    }

    // Obtener los resultados filtrados
    $incidencias = $query->get();

    // Obtener los valores para los selects de filtro
    $estados = Estado::pluck('nombre', 'id');
    $prioridades = Prioridad::pluck('nivel', 'id');

    // Retornar la vista con las variables necesarias
    return view('tecnico.index', compact('incidencias', 'estados', 'prioridades'));
}

    

    public function tecnicoShow($id)
    {
        $incidencia = Incidencia::with([
            'cliente',
            'tecnico',
            'estado',
            'prioridad',
            'imagen',
            'comentario' // Relación que debe estar definida en el modelo Incidencia
        ])->findOrFail($id);

        return view('tecnico.show', compact('incidencia'));
    }

    // Almacena un comentario (mensaje) para la incidencia
    public function storeComentario(Request $request, $incidenciaId)
    {
        // Validamos que se envíe un mensaje
        $data = $request->validate([
            'texto' => 'required|string'
        ]);

        $user = Auth::user();
        $data['incidencias_id'] = $incidenciaId;

        // Siempre se asigna como técnico (ignoras por completo el rol)
        $data['tecnico_id'] = $user->id;

        Comentario::create($data);

        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }


    public function iniciarTrabajo($id)
    {
        // Buscar la incidencia o retornar error 404 si no existe
        $incidencia = Incidencia::findOrFail($id);

        // Verificar que la incidencia esté en estado "Asignada"
        if (optional($incidencia->estado)->nombre === 'Asignada') {
            // Buscar el registro del estado "En trabajo"
            $estadoEnTrabajo = Estado::where('nombre', 'En trabajo')->first();

            if ($estadoEnTrabajo) {
                // Actualizar la incidencia
                $incidencia->estados_id = $estadoEnTrabajo->id;
                $incidencia->save();

                return redirect()->back()->with('success', 'La incidencia se ha actualizado a "En trabajo".');
            } else {
                return redirect()->back()->with('error', 'No se encontró el estado "En trabajo".');
            }
        }

        return redirect()->back()->with('error', 'La incidencia no se encuentra en estado "Asignada".');
    }

    public function finalizarTrabajo($id)
{
    // Buscar la incidencia o retornar error 404 si no existe
    $incidencia = Incidencia::findOrFail($id);

    // Verificar que la incidencia esté en estado "En trabajo"
    if (optional($incidencia->estado)->nombre === 'En trabajo') {
        // Buscar el registro del estado "Resuelta"
        $estadoFinalizada = Estado::where('nombre', 'Resuelta')->first();

        if ($estadoFinalizada) {
            // Actualizar la incidencia
            $incidencia->estados_id = $estadoFinalizada->id;
            // Actualizar la fecha de resolución con la fecha y hora actual
            $incidencia->fecha_resolucion = now();
            $incidencia->save();

            return redirect()->back()->with('success', 'La incidencia se ha actualizado a "Finalizada".');
        } else {
            return redirect()->back()->with('error', 'No se encontró el estado "Finalizada".');
        }
    }

    return redirect()->back()->with('error', 'La incidencia no se encuentra en estado "En trabajo".');
}


        
}
