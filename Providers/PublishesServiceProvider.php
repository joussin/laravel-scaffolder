<?php

namespace Api\Providers;

use Illuminate\Support\ServiceProvider;

class PublishesServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $dir = __DIR__ . '/../';

        // publish the config base file
        $this->publishes([
            $dir . 'config/laravel-scaffolder.php' => config_path('laravel-scaffolder.php'),
        ], 'config');

        // publish the default-template
        $this->publishes([
            $dir . 'Generated/resources/views/backoffice/' => base_path('resources/views/laravel-scaffolder'),
        ], 'views');


        // publish the swagger to public
        $this->publishes([
            $dir . 'Generated/public/api/docs/' => public_path("laravel-scaffolder/api/docs/"),
        ], 'swagger');



        // publish the routes
        $this->publishes([
            $dir . 'Generated/routes/' => base_path("routes/laravel-scaffolder"),
        ], 'routes');


    }

}
