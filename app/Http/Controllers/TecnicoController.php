<?php

namespace App\Http\Controllers;

use App\Models\Incidencia; // Asegúrate de tener el modelo Incidencia creado
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TecnicoController extends Controller
{
    // Muestra el dashboard del técnico
    public function dashboard()
    {
        return view('tecnico.dashboard');
    }

    // Muestra el listado de incidencias
    public function incidenciasIndex()
{
  

     // Filtra las incidencias para que solo se muestren las asignadas al usuario autenticado
     $incidencias = Incidencia::with('tecnico')
     ->where('tecnico_id', Auth::user()->id)
     ->get();

 return view('tecnico.incidencias.index', compact('incidencias'));
}



    // Muestra el formulario para crear una incidencia
    public function incidenciasCreate()
    {
        return view('tecnico.incidencias.create');
    }

    // Guarda una incidencia nueva
    public function incidenciasStore(Request $request)
    {
        $data = $request->validate([
            'titulo'      => 'required|string|max:50',
            'descripcion' => 'required',
            // Agrega validación de otros campos si es necesario
        ]);

        Incidencia::create($data);

        return redirect()->route('tecnico.incidencias.index');
    }

    // Muestra el detalle de una incidencia
    public function incidenciasShow($id)
    {
        $incidencia = Incidencia::findOrFail($id);
        return view('tecnico.incidencias.show', compact('incidencia'));
    }

    // Muestra el formulario para editar una incidencia
    public function incidenciasEdit($id)
    {
        $incidencia = Incidencia::findOrFail($id);
        return view('tecnico.incidencias.edit', compact('incidencia'));
    }

    // Actualiza una incidencia
    public function incidenciasUpdate(Request $request, $id)
    {
        $incidencia = Incidencia::findOrFail($id);
        $data = $request->validate([
            'titulo'      => 'required|string|max:50',
            'descripcion' => 'required',
            // Agrega validación de otros campos si es necesario
        ]);

        $incidencia->update($data);

        return redirect()->route('tecnico.incidencias.index');
    }

    // Elimina una incidencia
    public function incidenciasDestroy($id)
    {
        $incidencia = Incidencia::findOrFail($id);
        $incidencia->delete();

        return redirect()->route('tecnico.incidencias.index');
    }
}
