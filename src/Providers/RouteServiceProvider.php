<?php

namespace Yjtec\Rbac\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'Yjtec\Rbac\Controllers';
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Route::model('role',\Yjtec\Rbac\Models\Role::class);
        Route::model('access',\Yjtec\Rbac\Models\Access::class);
        Route::model('menu',\Yjtec\Rbac\Models\Menu::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function map()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(__DIR__.'/../routes/api.php');
    }
}
