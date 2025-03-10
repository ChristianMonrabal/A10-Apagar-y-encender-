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
    
            // Filtrar incidencias por sede y opcionalmente por técnico
            $incidencias = Incidencia::with('cliente', 'tecnico', 'gestor', 'subcategoria', 'estado', 'prioridad', 'comentario', 'imagen')
            ->whereHas('cliente', function ($query) use ($sedeGestor) {
                $query->where('sedes_id', $sedeGestor);
            })
            ->when($tecnico, function ($query) use ($tecnico) {
                $query->where('tecnico_id', $tecnico);
            })
            ->when($prioridad, function ($query) use ($prioridad) {
                $query->where('prioridades_id', $prioridad);
            })
            ->get();
    
            // Obtener lista de técnicos disponibles en la sede
            $tecnicosMiSede = Usuario::where('sedes_id', $sedeGestor)
            ->where('roles_id', 4)
            ->pluck('nombre', 'id');

            // Obtener lista de prioridades disponibles
            $prioridades = Prioridad::orderBy('id')->pluck('nivel', 'id');
    
            return view('manager.manager', compact('incidencias', 'tecnicosMiSede','prioridades'));
    
        } else {
            return redirect('/');
        }
    }
    
}
