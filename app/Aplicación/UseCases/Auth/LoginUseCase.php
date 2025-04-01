<?php

namespace App\Aplicación\UseCases\Auth;

use App\Aplicación\DTOs\Auth\LoginDTO;
use App\Aplicación\DTOs\Auth\LoginResponseDTO;
use App\Dominio\Repositorios\UserRepositoryInterface;
use App\Dominio\Servicios\AuthServiceInterface;

class LoginUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private AuthServiceInterface $authService
    ) {}

    public function execute(LoginDTO $dto): ?LoginResponseDTO
    {
        $tokenData = $this->authService->attemptLogin($dto->email, $dto->password);
        
        if (!$tokenData) {
            return null;
        }

        $user = $this->userRepository->findByEmail($dto->email);
        
        return new LoginResponseDTO(
            id: (string)$user->id,
            name: $user->name,
            email: $user->email,
            token: $tokenData['token']
        );
    }
}