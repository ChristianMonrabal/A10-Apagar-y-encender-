<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\Subcategoria;
use App\Models\Estado;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncidenciaController extends Controller
{
    /**
     * Muestra la lista de incidencias del cliente, con filtros y orden.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $estadoId = $request->input('estado');
        $hideResolved = $request->input('hide_resolved');
        $order = $request->input('order', 'DESC');

        $query = Incidencia::where('cliente_id', $user->id);
        if ($estadoId) {
            $query->where('estados_id', $estadoId);
        }
        if ($hideResolved) {
            $estadoResuelta = Estado::where('nombre', 'Resuelta')->first();
            if ($estadoResuelta) {
                $query->where('estados_id', '!=', $estadoResuelta->id);
            }
        }
        $incidencias = $query->orderBy('created_at', $order)->get();
        $estados = Estado::all();
        return view('incidencias.index', compact('incidencias', 'estados', 'order'));
    }
    
    /**
     * Muestra el formulario para crear una nueva incidencia.
     */
    public function create()
    {
        // Se obtienen las categorías para el select
        $categorias = Categoria::all();
        return view('incidencias.create', compact('categorias'));
    }
    
    /**
     * Guarda la nueva incidencia.
     */
    public function store(Request $request)
{
    $user = Auth::user();
    
    // Validación de datos...
    $request->validate([
        'titulo'          => 'required|string|max:255',
        'descripcion'     => 'required|string',
        'categoria_id'    => 'required|exists:categorias,id',
        'subcategoria_id' => 'required|exists:subcategorias,id',
        'comentario'      => 'nullable|string',
        'imagen'          => 'nullable|image|max:2048',
    ]);

    // Validar que la subcategoría pertenece a la categoría seleccionada
    $subcategoria = Subcategoria::findOrFail($request->input('subcategoria_id'));
    if ($subcategoria->categorias_id != $request->input('categoria_id')) {
        return back()->withErrors('La subcategoría seleccionada no pertenece a la categoría elegida.');
    }
    
    // Obtener el estado "Sin asignar"
    $estado = Estado::where('nombre', 'Sin asignar')->first();
    if (!$estado) {
        return back()->withErrors('Estado "Sin asignar" no encontrado.');
    }

    try {
        DB::transaction(function () use ($request, $user, $estado) {
            // Crear la incidencia
            $incidencia = new Incidencia();
            $incidencia->titulo = $request->input('titulo');
            $incidencia->descripcion = $request->input('descripcion');
            $incidencia->subcategorias_id = $request->input('subcategoria_id');
            $incidencia->estados_id = $estado->id;
            $incidencia->cliente_id = $user->id;
            $incidencia->save();
            
            // Guardar comentario inicial (opcional)
            if ($request->filled('comentario')) {
                $incidencia->comentario()->create([
                    'cliente_id' => $user->id,
                    'texto'      => $request->input('comentario'),
                ]);
            }
            
            // Guardar imagen si se ha subido
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $filename = $file->hashName();  // Nombre hash similar a store()
                $destinationPath = public_path('img/incidencias');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $file->move($destinationPath, $filename);
                $incidencia->imagen()->create([
                    'ruta' => 'img/incidencias/' . $filename,
                ]);
            }
        });
    } catch (\Exception $e) {
        return back()->withErrors('Ocurrió un error al registrar la incidencia: ' . $e->getMessage());
    }
    
    return redirect()->route('incidencias.index')
                     ->with('success', 'Incidencia registrada correctamente.');
}
    
    /**
     * Muestra el detalle de una incidencia.
     */
    public function show($id)
    {
        $user = Auth::user();
        $incidencia = Incidencia::findOrFail($id);
        if ($incidencia->cliente_id != $user->id) {
            abort(403);
        }
        return view('incidencias.show', compact('incidencia'));
    }
    
    /**
     * Guarda un nuevo comentario (mensaje del chat) para la incidencia.
     */
    public function addComment(Request $request, $id)
    {
        $incidencia = Incidencia::findOrFail($id);
        $user = Auth::user();

        $request->validate([
            'comentario' => 'required|string'
        ]);

        if ($user->roles_id === 1) { // Cliente
            $incidencia->comentario()->create([
                'cliente_id' => $user->id,
                'texto'      => $request->input('comentario'),
            ]);
        } else { // Técnico (o cualquier otro rol)
            $incidencia->comentario()->create([
                'tecnico_id' => $user->id,
                'texto'      => $request->input('comentario'),
            ]);
        }

        return redirect()->route('incidencias.show', $id)->with('success', 'Comentario añadido.');
    }

    /**
     * Cambia el estado de la incidencia de "Resuelta" a "Cerrada".
     */
    public function close(Request $request, $id)
    {
        $user = Auth::user();
        $incidencia = Incidencia::findOrFail($id);

        // Verifica que la incidencia pertenezca al usuario actual
        if ($incidencia->cliente_id != $user->id) {
            abort(403, 'No tienes permiso para cerrar esta incidencia.');
        }
        
        // Verifica que la incidencia esté en estado "Resuelta"
        if ($incidencia->estado->nombre !== 'Resuelta') {
            return redirect()->route('incidencias.show', $id)
                            ->with('error', 'La incidencia no se encuentra en estado "Resuelta".');
        }
        
        // Buscar el estado "Cerrada"
        $estadoCerrada = Estado::where('nombre', 'Cerrada')->first();
        if (!$estadoCerrada) {
            return redirect()->route('incidencias.show', $id)
                            ->with('error', 'Estado "Cerrada" no encontrado.');
        }
        
        // Actualiza el estado de la incidencia a "Cerrada"
        $incidencia->estados_id = $estadoCerrada->id;
        $incidencia->save();

    return redirect()->route('incidencias.show', $id)
                     ->with('success', 'Incidencia cerrada correctamente.');
}
}
