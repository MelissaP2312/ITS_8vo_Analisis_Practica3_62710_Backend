<?php

namespace App\Dominio\Entidades;

class User
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public ?string $password = null
    ) {}
}
