<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;
use App\Models\Estado;

class TecnicoController extends Controller
{
    public function dashboard()
    {
        return view('tecnico.index');
    }

    public function tecnicoIndex()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $incidencias = Incidencia::where('tecnico_id', $user->id)->get();
        return view('tecnico.index', compact('incidencias'));
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
            // Buscar el registro del estado "Finalizada"
            $estadoFinalizada = Estado::where('nombre', 'Resuelta')->first();

            if ($estadoFinalizada) {
                // Actualizar la incidencia
                $incidencia->estados_id = $estadoFinalizada->id;
                $incidencia->save();

                return redirect()->back()->with('success', 'La incidencia se ha actualizado a "Finalizada".');
            } else {
                return redirect()->back()->with('error', 'No se encontró el estado "Finalizada".');
            }
        }

        return redirect()->back()->with('error', 'La incidencia no se encuentra en estado "En trabajo".');
    }
}