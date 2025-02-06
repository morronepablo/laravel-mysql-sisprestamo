<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('ver-configuracion', function ($user) {
            return $user->hasPermissionTo('admin.configuracion.index');
        });

        Gate::define('ver-roles', function ($user) {
            return $user->hasPermissionTo('admin.roles.index');
        });

        Gate::define('ver-usuarios', function ($user) {
            return $user->hasPermissionTo('admin.usuarios.index');
        });

        Gate::define('ver-clientes', function ($user) {
            return $user->hasPermissionTo('admin.clientes.index');
        });

        Gate::define('ver-prestamos', function ($user) {
            return $user->hasPermissionTo('admin.prestamos.index');
        });

        Gate::define('ver-pagos', function ($user) {
            return $user->hasPermissionTo('admin.pagos.index');
        });

        Gate::define('ver-notificaciones', function ($user) {
            return $user->hasPermissionTo('admin.notificaciones.index');
        });

        Gate::define('ver-backups', function ($user) {
            return $user->hasPermissionTo('admin.backups.index');
        });
    }
}
