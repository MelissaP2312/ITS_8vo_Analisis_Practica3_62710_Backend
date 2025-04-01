<?php

namespace App\Aplicación\DTOs\Auth;

class LoginDTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {}
}