<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;

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
        // Según el rol, se asigna el comentario al técnico (rol 4) o al cliente (rol 1, u otro)
        if ($user->rol_id == 4) {
            $data['tecnico_id'] = $user->id;
        } else {
            $data['cliente_id'] = $user->id;
        }

        Comentario::create($data);

        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }
}

