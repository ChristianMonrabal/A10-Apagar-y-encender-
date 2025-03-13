<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Prioridad;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GestorController extends Controller
{
    public function incidencias(Request $request) {

        if (Auth::check() && Auth::user()->roles_id === 3) {
    
            $sedeGestor = Auth::user()->sedes_id;
            $tecnico = $request->input('tecnico');
            $prioridad = $request->input('prioridad');
            $orden = $request->input('orden', 'desc');
            $estado = $request->input('estado');
    
            // Consulta de incidencias con filtros dinámicos
            $incidencias = Incidencia::with('cliente', 'tecnico', 'gestor', 'subcategoria', 'estado', 'prioridad', 'comentario', 'imagen')
                ->whereHas('cliente', function ($query) use ($sedeGestor) {
                    $query->where('sedes_id', $sedeGestor);
                })
                ->when($estado === 'abiertas', function ($query) {
                    $query->where('estados_id', '!=', 5);
                })
                ->when($tecnico, function ($query) use ($tecnico) {
                    $query->where('tecnico_id', $tecnico);
                })
                ->when($prioridad, function ($query) use ($prioridad) {
                    $query->where('prioridades_id', $prioridad);
                })
                ->orderBy('created_at', $orden)
                ->get();
    
            // Si es una solicitud AJAX, retornamos solo los datos
            if ($request->expectsJson()) {
                return response()->json(['incidencias' => $incidencias]);
            }
    
            // Si no es AJAX, cargamos la vista normal
            $tecnicosMiSede = Usuario::where('sedes_id', $sedeGestor)
                ->where('roles_id', 4)
                ->pluck('nombre', 'id');
    
            $prioridades = Prioridad::orderBy('id')->pluck('nivel', 'id');
    
            return view('manager.manager', compact('incidencias', 'tecnicosMiSede', 'prioridades'));

        } else {

            return redirect('/');

        }
    

    }
    
    public function actualizarTecnico($id, Request $request) {

        $incidencia = Incidencia::findOrFail($id);

        $incidencia->tecnico_id = $request->tecnico_id;
        $incidencia->save();

        return response()->json(['success' => true]);

    }

    public function actualizarPrioridad($id, Request $request) {

        $incidencia = Incidencia::findOrFail($id);

        $incidencia->prioridades_id = $request->prioridad_id;
        $incidencia->save();

        return response()->json(['success' => true]);
        
    }

}
