<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Dominio\Servicios\AuthServiceInterface; // Cambiado a Src
use App\Infraestructura\Persistencia\JWT\JwtService; // Cambiado a Src
use App\Dominio\Repositorios\UserRepositoryInterface;
use App\Infraestructura\Persistencia\EloquentUserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );
        
        $this->app->bind(
            AuthServiceInterface::class,
            JwtService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->configureRateLimiting();
        
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}