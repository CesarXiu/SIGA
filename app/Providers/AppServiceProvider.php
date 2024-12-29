<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
// Importacion de los Modelos
use App\Models\Siga\Solicitud;
use App\Models\Siga\Scope;
use App\Models\Siga\Modelos;
// Importacion de las Politicas
use App\Policies\SolicitudPolicy;
use App\Policies\ScopePolicy;
use App\Policies\ModeloPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Solicitud::class, SolicitudPolicy::class);
        Gate::policy(Scope::class, ScopePolicy::class);
        Gate::policy(Modelos::class, ModeloPolicy::class);
    }
}
