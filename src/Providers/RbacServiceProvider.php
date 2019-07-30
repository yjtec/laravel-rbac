<?php

namespace Yjtec\Rbac\Providers;

use Illuminate\Support\ServiceProvider;

class RbacServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');


        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
            __DIR__.'/../database/seeds/' => database_path('seeds'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Yjtec\Rbac\Repositories\Contracts\RoleInterface', 'Yjtec\Rbac\Repositories\Eloquent\RoleRepository');
        $this->app->bind('Yjtec\Rbac\Repositories\Contracts\AccessInterface', 'Yjtec\Rbac\Repositories\Eloquent\AccessRepository');
        $this->app->bind('Yjtec\Rbac\Repositories\Contracts\MenuInterface', 'Yjtec\Rbac\Repositories\Eloquent\MenuRepository');
    }
}
