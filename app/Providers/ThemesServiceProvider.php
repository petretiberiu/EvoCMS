<?php

namespace App\Providers;

use App\Themes\Theme;
use Illuminate\Support\ServiceProvider;

class ThemesServiceProvider extends ServiceProvider {

    public $themes = [
        'My_Theme'=> \App\Themes\My_Theme\MyTheme::class
    ];

    /**
     * @var Theme $loadedTheme
     */
    private $loadedTheme = null;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $this->loadedTheme = Theme::load($this->themes)->registerServiceProviders($this->app);
        if(!is_null($this->loadedTheme) && class_basename($this->loadedTheme) != Theme::class)
            $this->loadedTheme->boot();
    }
}
