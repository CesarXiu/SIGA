<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
// Importacion de los Modelos
use App\Models\Siga\Solicitud;
use App\Models\Siga\Scope;
use App\Models\Siga\Modelos;
use App\Models\Siga\Ruta;
use App\Models\Siga\Rol;
use App\Models\Siga\Permiso;
use App\Models\Siga\EndPoint;
// Importacion de las Politicas
use App\Policies\SolicitudPolicy;
use App\Policies\ScopePolicy;
use App\Policies\ModeloPolicy;
use App\Policies\RutaPolicy;
use App\Policies\RolPolicy;
use App\Policies\PermisoPolicy;
use App\Policies\EndPointPolicy;

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
        Gate::policy(Ruta::class, RutaPolicy::class);
        Gate::policy(Rol::class, RolPolicy::class);
        Gate::policy(Permiso::class, PermisoPolicy::class);
        Gate::policy(EndPoint::class, EndPointPolicy::class);
        
    }
}
