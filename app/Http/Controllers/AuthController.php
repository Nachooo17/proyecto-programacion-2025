<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|unique:users,email',
            'contrasena' => 'required|string|min:6|confirmed',
        ]);

        $usuario = User::create([
            'name' => $request->nombre,
            'email' => $request->correo,
            'password' => Hash::make($request->contrasena),
        ]);

        $token = $usuario->createToken('authToken')->accessToken;

        return response()->json([
            'usuario' => $usuario,
            'token' => $token
        ]);
    }

    public function iniciarSesion(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->correo)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['mensaje' => 'Credenciales incorrectas'], 401);
        }

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'usuario' => $user,
            'token' => $token
        ]);
    }
}

