<?php

namespace App\Infraestructura\Persistencia\JWT;

use App\Dominio\Servicios\AuthServiceInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtService implements AuthServiceInterface
{
    public function attemptLogin(string $email, string $password): ?array
    {
        if (!$token = auth()->attempt(['email' => $email, 'password' => $password])) {
            return null;
        }
        
        return [
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }

    public function logout(): void
    {
        auth()->logout();
    }
}