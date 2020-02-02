<?php


namespace App\Themes\My_Theme\Providers;

use App\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {
    protected $namespace = 'App\Themes\My_Theme\Controllers';
    protected function mapWebRoutes() {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('app/Themes/My_Theme/Routes/web.php'));
    }
}
