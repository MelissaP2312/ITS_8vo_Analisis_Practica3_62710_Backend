<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Infraestructura\Adaptadores\Controllers\AuthController;

/* Public Routes */
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

/* Protected Routes */
Route::middleware(['auth:sanctum'])->group(function () {
    // Ruta raíz protegida - Solo accesible con autenticación
    Route::get('/', function (Request $request) {
        return response()->json([
            'status' => 'success',
            'message' => 'Bienvenido al área protegida',
            'user' => $request->user()->only(['id', 'name', 'email']),
        ]);
    });

    // Endpoint para obtener datos del usuario autenticado
    Route::get('/user', [AuthController::class, 'user']);
    
    // Cerrar sesión
    
});
Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'logout']);
