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
    }
}
