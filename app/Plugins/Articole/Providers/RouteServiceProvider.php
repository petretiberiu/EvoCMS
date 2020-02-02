<?php
namespace App\Plugins\Articole\Providers;

use App\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
    protected $namespace = 'App\Plugins\Articole\Controllers';

    private $routes = [
        'app/Plugins/Articole/Routes/articole.php',
        'app/Plugins/Articole/Routes/categorii.php'
    ];

    protected function mapWebRoutes() {
        foreach ($this->routes as $route) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path($route));
        }
    }
}
