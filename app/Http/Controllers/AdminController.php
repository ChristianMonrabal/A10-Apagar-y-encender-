<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }

    public function create()
    {
        $roles = Rol::all();  
        $sedes = Sede::all();
        
        return view('admin.create', compact('roles', 'sedes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
            'roles_id' => 'required|exists:roles,id',
            'sedes_id' => 'required|exists:sedes,id',
        ]);

        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->roles_id = $request->roles_id;
        $usuario->sedes_id = $request->sedes_id;
        $usuario->activo = true;

        if ($usuario->save()) {
            return redirect()->route('admin')->with('success', 'Usuario creado exitosamente.');
        } else {
            return redirect()->route('admin.create')->with('error', 'Hubo un error al crear el usuario.');
        }
    }
}
