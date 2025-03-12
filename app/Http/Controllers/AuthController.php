<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            switch ($user->roles_id) {
                case 1:
                    return redirect('/client');
                case 2:
                    return redirect('/admin');
                case 3:
                    return redirect('/manager');
                default:
                    return redirect('/');
            }
        }
        return view('auth.login');
    }
    

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Este campo no puede estar vacío.',
            'email.email' => 'El email debe ser una dirección de correo válida.',
            'password.required' => 'Este campo no puede estar vacío.',
        ]);

        $user = Usuario::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->activo) {
                Auth::login($user);
                $request->session()->regenerate();

                switch ($user->roles_id) {
                    case 1:
                        return redirect('/client');
                    case 2: 
                        return redirect('/admin');
                    case 3: 
                        return redirect('/manager');
                    case 4: 
                        return redirect('/tecnico');
                    default: 
                        return redirect('/');
                }
            } else {
                return back()->withErrors([
                    'login' => 'Tu cuenta está inactiva, contacta al administrador.',
                ]);
            }
        }

        return back()->withErrors([
            'login' => 'Las credenciales son incorrectas.',
        ])->withInput(['email' => $request->email]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
