<?php

namespace App\Providers;

use App\Plugins\Plugin;
use Illuminate\Support\ServiceProvider;

class PluginServiceProvider extends ServiceProvider {
    public $loadedPlugins = [];
    /**
     * @var Plugin[] $plugins
     */
    private $plugins;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $this->plugins = include base_path('app\Plugins\plugins.php');
        foreach ($this->plugins as $key=>$plugin) {
            $this->loadedPlugins[$key] = $plugin::load()->registerPlugin($this->app);
        }
    }
}
