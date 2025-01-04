<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
// Importacion de los Modelos
use App\Models\Siga\Solicitud;
use App\Models\Siga\Scope;
use App\Models\Siga\Modelos;
use App\Models\Siga\Ruta;
use App\Models\Siga\Rol;
use App\Models\Siga\Permiso;
use App\Models\Siga\EndPoint;
use App\Models\Siga\Consumidor;
use App\Models\Siga\Compartido;
// Importacion de las Politicas
use App\Policies\SolicitudPolicy;
use App\Policies\ScopePolicy;
use App\Policies\ModeloPolicy;
use App\Policies\RutaPolicy;
use App\Policies\RolPolicy;
use App\Policies\PermisoPolicy;
use App\Policies\EndPointPolicy;
use App\Policies\ConsumidorPolicy;
use App\Policies\CompartidoPolicy;
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
     * Método boot del proveedor de servicios de la aplicación.
     *
     * Este método se ejecuta durante el arranque de la aplicación y se utiliza para definir políticas de acceso y configurar la expiración de los tokens de Passport.
     *
     * - Definición de las políticas:
     *   - Solicitud: SolicitudPolicy
     *   - Scope: ScopePolicy
     *   - Modelos: ModeloPolicy
     *   - Ruta: RutaPolicy
     *   - Rol: RolPolicy
     *   - Permiso: PermisoPolicy
     *   - EndPoint: EndPointPolicy
     *   - Consumidor: ConsumidorPolicy
     *   - Compartido: CompartidoPolicy
     *
     * - Configuración de Passport:
     *   - Los tokens expiran en 12 horas.
     *   - Los tokens de refresco expiran en 7 días.
     *
     * @return void
     */
    public function boot(): void
    {
        // Definicion de las politicas
        Gate::policy(Solicitud::class, SolicitudPolicy::class);
        Gate::policy(Scope::class, ScopePolicy::class);
        Gate::policy(Modelos::class, ModeloPolicy::class);
        Gate::policy(Ruta::class, RutaPolicy::class);
        Gate::policy(Rol::class, RolPolicy::class);
        Gate::policy(Permiso::class, PermisoPolicy::class);
        Gate::policy(EndPoint::class, EndPointPolicy::class);
        Gate::policy(Consumidor::class, ConsumidorPolicy::class);
        Gate::policy(Compartido::class, CompartidoPolicy::class);
        // CONFIGURACION DE PASSPORT
        Passport::tokensExpireIn(now()->addHours(12));
        Passport::refreshTokensExpireIn(now()->addDays(7));
    }
}
