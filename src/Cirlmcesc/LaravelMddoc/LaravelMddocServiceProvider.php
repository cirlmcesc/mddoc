<?php

namespace Cirlmcesc\LaravelMddoc;

use Illuminate\Support\ServiceProvider;


class LaravelMddocServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__."/../../config/mddoc.php", "mddoc");
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Commands
         */
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Cirlmcesc\LaravelMddoc\GenerateMarkdownCommand::class,
            ]);
        }

        /**
         * Config
         */
        $this->loadRoutesFrom(__DIR__."/../../routes/routes.php");

        $this->publishes([
            __DIR__."/../../config/mddoc.php" => config_path("mddoc.php"),
        ], "config");

        /**
         * View
         */
        $this->loadViewsFrom(__DIR__."/../../views", 'laravelmddoc');
    }
}