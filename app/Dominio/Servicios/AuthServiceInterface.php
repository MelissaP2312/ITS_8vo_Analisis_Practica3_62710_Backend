<?php

namespace app\Dominio\Servicios;

interface AuthServiceInterface
{
    public function attemptLogin(string $email, string $password): ?array;
    public function logout(): void;
}