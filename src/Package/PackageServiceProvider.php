<?php

namespace LaravelHungary\Announcement;

use Illuminate\Support\ServiceProvider;

/**
 * A Redis Based Announcement Package.
 *
 * @author: Jozsef Hocza
 */
class PackageServiceProvider extends ServiceProvider
{
    protected $packageName = 'announcement';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        include __DIR__.'/../routes.php';

        // Register Views from your package
        $this->loadViewsFrom(__DIR__.'/../views', $this->packageName);

        // Publish your config
        $this->publishes([
            __DIR__.'/../config/config.php'                     => config_path($this->packageName.'.php'),
            __DIR__.'/../views/alert.blade.php'                 => resource_path('views/vendor/'.$this->packageName.'/alert.blade.php'),
            __DIR__.'/../Events/NewAnnouncement.php'            => app_path('Events/NewAnnouncement.php'),
            __DIR__.'/../components/Announcement-bootstrap.vue' => resource_path('assets/js/components/Announcement-bootstrap.vue'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', $this->packageName);

        $this->app['announce'] = $this->app->share(function ($app) {
            return new Announce();
        });
    }
}
