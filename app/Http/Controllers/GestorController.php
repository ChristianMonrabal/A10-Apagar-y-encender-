<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GestorController extends Controller
{
    public function incidencias() {

        if (Auth::check() && Auth::user()->roles_id === 3) {

            $incidencias = Incidencia::with('cliente','tecnico','gestor','subcategoria','estado','prioridad','comentario','imagen')->get();
            return view('manager.manager', compact('incidencias'));

        } else {

            return redirect('/');

        }

    }
}
