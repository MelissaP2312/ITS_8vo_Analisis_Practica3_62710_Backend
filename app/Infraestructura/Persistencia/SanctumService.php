<?php

namespace App\Infraestructura\Persistencia;

use App\Dominio\Servicios\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SanctumService implements AuthServiceInterface
{
    public function attemptLogin(string $email, string $password): ?array
    {
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return null;
        }
        
        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return [
            'token' => $token,
            'expires_in' => null // Sanctum tokens no tienen expiración por defecto
        ];
    }

    public function logout(): void
    {
        Auth::user()->currentAccessToken()->delete();
    }
}