<?php

namespace App\Aplicación\DTOs\Auth;

class LoginResponseDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public string $token
    ) {}
}