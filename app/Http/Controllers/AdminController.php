<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Sede;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->roles_id !== 2) {
            return redirect('/');
        }
    
        $nombre = $request->input('nombre');
        $roles_id = $request->input('roles_id');
        $sedes_id = $request->input('sedes_id');
        $activo = $request->input('activo');
    
        $query = Usuario::query();
    
        if (!empty($nombre)) {
            $query->where('nombre', 'like', "%$nombre%");
        }
        if (!empty($roles_id)) {
            $query->where('roles_id', $roles_id);
        }
        if (!empty($sedes_id)) {
            $query->where('sedes_id', $sedes_id);
        }
        if ($activo !== null && $activo !== '') {
            $query->where('activo', $activo);
        }
    
        $usuarios = $query->get();
        $roles = Rol::all();
        $sedes = Sede::all();
    
        $estados = Usuario::select('activo')
                        ->distinct()
                        ->get()
                        ->pluck('activo', 'activo')
                        ->toArray();
    
        $estados = [
            '1' => 'Activo',
            '0' => 'Desactivado',
        ];
    
        return view('admin.admin', compact('usuarios', 'roles', 'sedes', 'estados'));
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
        ], [
            'nombre.required' => 'Este campo no puede estar vacío.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe exceder los 255 caracteres.',
            
            'email.required' => 'Este campo no puede estar vacío.',
            'email.email' => 'El email debe ser una dirección de correo válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            
            'password.required' => 'Este campo no puede estar vacío.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            
            'roles_id.required' => 'El rol es obligatorio.',
            'roles_id.exists' => 'El rol seleccionado no es válido.',
            
            'sedes_id.required' => 'La sede es obligatoria.',
            'sedes_id.exists' => 'La sede seleccionada no es válida.',
        ]);

        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->roles_id = $request->roles_id;
        $usuario->sedes_id = $request->sedes_id;
        $usuario->activo = true;

        if ($usuario->save()) {
            session()->flash('success', 'El usuario se ha creado correctamente.');
        } else {
            session()->flash('error', 'Ha ocurrido un error al crear el usuario.');
        }
        return redirect()->route('admin.create');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::all();
        $sedes = Sede::all();

        return view('admin.update', compact('usuario', 'roles', 'sedes'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email|unique:usuarios,email,' . $id,
        'password' => 'nullable|string|min:6',
        'roles_id' => 'required|exists:roles,id',
        'sedes_id' => 'required|exists:sedes,id',
    ], [
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.string' => 'El nombre debe ser una cadena de texto.',
        'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
        
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'Por favor, ingrese una dirección de correo válida.',
        'email.unique' => 'Este correo electrónico ya está en uso.',
        
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        
        'roles_id.required' => 'El rol es obligatorio.',
        'roles_id.exists' => 'El rol seleccionado no existe.',
        
        'sedes_id.required' => 'La sede es obligatoria.',
        'sedes_id.exists' => 'La sede seleccionada no existe.',
    ]);
    
    $usuario = Usuario::findOrFail($id);
    $usuario->nombre = $request->nombre;
    $usuario->email = $request->email;
    if ($request->password) {
        $usuario->password = Hash::make($request->password);
    }
    $usuario->roles_id = $request->roles_id;
    $usuario->sedes_id = $request->sedes_id;
    $usuario->activo = true;

    if ($usuario->save()) {
        session()->flash('success', 'El usuario se ha actualizado correctamente.');
    } else {
        session()->flash('error', 'Ha ocurrido un error al actualizar el usuario.');
    }
    
    $roles = Rol::all();
    $sedes = Sede::all();
    
    return view('admin.update', compact('usuario', 'roles', 'sedes'));
}


public function destroy($id)
{
    DB::beginTransaction(); 

    try {
        $usuario = Usuario::findOrFail($id);

        $usuario->incidencia_cliente()->each(function ($incidencia) {
            $incidencia->comentario()->delete();
            $incidencia->imagen()->delete();
        });
        
        $usuario->incidencia_cliente()->delete();
        $usuario->incidencia_tecnico()->delete();
        $usuario->incidencia_gestor()->delete();

        if ($usuario->delete()) {
            DB::commit(); 
            return redirect()->route('admin.admin')->with('success', 'Usuario eliminado exitosamente.');
        } else {
            throw new \Exception("Hubo un error al eliminar el usuario.");
        }
    } catch (\Exception $e) {
        DB::rollBack(); 

        return redirect()->route('admin.admin')->with('error', 'Hubo un error al eliminar el usuario. ' . $e->getMessage());
    }
}

    public function disable($id)
{
    $usuario = Usuario::findOrFail($id);
    $usuario->activo = false;
    
    if ($usuario->save()) {
        session()->flash('success', 'El usuario ha sido desactivado correctamente.');
    } else {
        session()->flash('error', 'Hubo un error al desactivar el usuario.');
    }

    return redirect()->route('admin.admin');
}

    public function enable($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->activo = true;

        if ($usuario->save()) {
            session()->flash('success', 'El usuario ha sido activado correctamente.');
        } else {
            session()->flash('error', 'Hubo un error al activar el usuario.');
        }

        return redirect()->route('admin.admin');
    }

    public function createCategory()
{
    return view('admin.create_category');
}

public function storeCategory(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255|unique:categorias,nombre',
    ], [
        'nombre.required' => 'Este campo no puede estar vacío.',
        'nombre.unique' => 'Este nombre de categoría ya está en uso.',
    ]);

    $categoria = new Categoria();
    $categoria->nombre = $request->nombre;

    if ($categoria->save()) {
        session()->flash('success', 'Categoría creada exitosamente.');
    } else {
        session()->flash('error', 'Hubo un error al crear la categoría.');
    }

    return redirect()->route('admin.create.category');
}

public function createSubcategory()
{
    $categorias = Categoria::all();
    return view('admin.create_subcategory', compact('categorias'));
}

public function storeSubcategory(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255|unique:subcategorias,nombre',
        'categorias_id' => 'required|exists:categorias,id',
    ], [
        'nombre.required' => 'Este campo no puede estar vacío.',
        'nombre.unique' => 'Este nombre de subcategoría ya está en uso.',
        'categorias_id.required' => 'La categoría es obligatoria.',
        'categorias_id.exists' => 'La categoría seleccionada no es válida.',
    ]);

    $subcategoria = new Subcategoria();
    $subcategoria->nombre = $request->nombre;
    $subcategoria->categorias_id = $request->categorias_id;

    if ($subcategoria->save()) {
        session()->flash('success', 'Subcategoría creada exitosamente.');
    } else {
        session()->flash('error', 'Hubo un error al crear la subcategoría.');
    }

    return redirect()->route('admin.create.subcategory');
}
}

