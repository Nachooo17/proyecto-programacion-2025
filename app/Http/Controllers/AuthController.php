<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function registrar(RegisterRequest $request)
    {
        $usuario = User::create([
            'name' => $request->nombre,
            'email' => $request->correo,
            'password' => Hash::make($request->contrasena),
        ]);

        $token = $usuario->createToken('authToken')->accessToken;

        return response()->json([
            'mensaje' => 'Usuario registrado correctamente.',
            'usuario' => $usuario,
            'token' => $token
        ], 201);
    }

    public function iniciarSesion(LoginRequest $request)
    {
        $usuario = User::where('email', $request->correo)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
           return response()->json(['mensaje' => 'Credenciales incorrectas.'], 401);
}


        $token = $usuario->createToken('authToken')->accessToken;

        return response()->json([
            'mensaje' => 'Inicio de sesión exitoso.',
            'usuario' => $usuario,
            'token' => $token
        ]);
    }
}



