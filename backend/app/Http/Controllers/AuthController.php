<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }
        $user = auth()->user()->load('rol');
        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Sesion cerrada']);
    }
    public function prueba()
    {
        return response()->json(['message' => 'Prueba de visitante']);
    }

    public function me()
    {   
        $user = auth()->user()->load('rol');
        return response()->json($user);
    }
}
