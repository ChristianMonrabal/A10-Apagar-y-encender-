<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Incidencia;

class TecnicoController 
{
    // Muestra las incidències asignades al técnico autenticado
    public function index()
    {
        // Operación de lectura: no se requiere transacción
        $incidences = Incidencia::where('technician_id', auth()->id())->get();
        return view('tecnicos.incidencies', compact('incidences'));
    }

    // Actualiza el estado de la incidencia: de "Assignada" a "En treball" o de "En treball" a "Resolta"
    public function updateStatus(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $incidence = Incidencia::findOrFail($id);
            $incidence->status = $request->input('status');
            $incidence->save();

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Envía un mensaje relacionado con la incidencia al cliente
    public function sendMessage(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Si tienes un modelo Message, podrías guardar el mensaje de la siguiente forma:
            // Message::create([
            //     'incidence_id' => $id,
            //     'content'      => $request->input('message'),
            //     'sender_id'    => auth()->id(),
            // ]);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
