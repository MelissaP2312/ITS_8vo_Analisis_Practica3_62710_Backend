<?php

namespace App\Infraestructura\Persistencia\Eloquent;

use App\Dominio\Entidades\User;
use App\Dominio\Repositorios\UserRepositoryInterface;
use App\Models\User as EloquentUser;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        $user = EloquentUser::where('email', $email)->first();
        
        if (!$user) {
            return null;
        }
        
        return new User(
            id: (string)$user->id,
            name: $user->name,
            email: $user->email
        );
    }
}