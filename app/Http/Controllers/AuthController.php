<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4'
        ]);

        if (!auth()->attempt($data)) {
            return response()->json(['message' => 'Credenciais inválidas', 401]);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response()->json(['user' => auth()->user(), 'access_token' => $accessToken], 200);
    }
}
