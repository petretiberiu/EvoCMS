<?php


namespace App\Plugins\Articole;

use App\Plugins\Meniu\MeniuPlugin;
use App\Plugins\Plugin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Class ArticolePlugin
 * @package App\Plugins\Articole
 * @var ArticolePlugin $plugin
 * @var ServiceProvider[] $serviceProviders
 * @var Plugin[] $dependencies
 * @var Plugin[] $loadedDependencies
 */
class ArticolePlugin extends Plugin {
    protected static $plugin;
    public $serviceProviders = [
        \App\Plugins\Articole\Providers\RouteServiceProvider::class
    ];
    public $dependencies = [
        'Meniu' => \App\Plugins\Meniu\MeniuPlugin::class
    ];
    public $loadedDependencies;
    public function registerPlugin(Application &$app) {
        parent::registerPlugin($app);
        foreach (self::$plugin->serviceProviders as $provider) {
            $app->register($provider);
        }
        return self::$plugin;
    }
    public static function load() {
        if(is_null(self::$plugin)) {
            self::$plugin = new ArticolePlugin();
            if(array_key_exists('Meniu', self::$plugin->dependencies)) {
                /**
                 * @var MeniuPlugin $meniuPlugin
                 */
                $meniuPlugin = self::$plugin->loadedDependencies['Meniu'] = self::$plugin->dependencies['Meniu']::load();
                $meniuPlugin->AddMenuItems('MainMenu', [
                    $meniuPlugin->classes['MenuItem']::load("Articole", "#page-layouts", $meniuPlugin->classes['Menu']::load('Articole', true)->group([
                        $meniuPlugin->classes['MenuItem']::load("Categorii", "/categorie", null, ''),
                        $meniuPlugin->classes['MenuItem']::load('Vezi articol', '/articol', null, ''),
                        $meniuPlugin->classes['MenuItem']::load('Adauga articol', '/articol/create', null, ''),
                    ]), 'mdi-apps')
                ]);
            }
            View::addNamespace('Articole', realpath(base_path('app/Plugins/Articole/Views')));
        }
        return self::$plugin;
    }
}
