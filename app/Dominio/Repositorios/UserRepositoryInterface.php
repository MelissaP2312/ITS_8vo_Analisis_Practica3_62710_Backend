<?php

namespace App\Dominio\Repositorios;

use App\Dominio\Entidades\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}
