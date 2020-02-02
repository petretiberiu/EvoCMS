<?php

namespace App\Themes\My_Theme;

use App\Themes\Theme;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\View;

class MyTheme extends Theme {
    public static $themeName = 'My_Theme';
    public static $serviceProviders = [
        \App\Themes\My_Theme\Providers\RouteServiceProvider::class
    ];
    public function registerServiceProviders(Application &$app) {
        foreach (self::$serviceProviders as $provider)
            $app->register($provider);
        return parent::registerServiceProviders($app);
    }
    public function boot() {
        View::addNamespace('Theme', realpath(base_path('app/Themes/My_Theme/Views')));
        return self::$themeController;
    }
}
