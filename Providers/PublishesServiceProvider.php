<?php

namespace Api\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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


    public function loadFromPackage()
    {
        //config
        $this->mergeConfigFrom(base_path("src/config/laravel-scaffolder.php"), "laravel-scaffolder");

        // views
        $this->loadViewsFrom(base_path('src/Generated/resources/views/backoffice'), "laravel-scaffolder");

        // swagger
        $this->loadRoutesFrom(base_path('src/Generated/routes/routes-swagger.php' ));

        // routes
        $generated_route_dir = base_path("src/Generated/routes/");
        if (File::isDirectory($generated_route_dir)) {
            $routesFiles = File::files(($generated_route_dir));
            foreach ($routesFiles as $routesFile) {
                if(env('ROUTES_RESOURCE') && Str::contains($routesFile->getRelativePathname(), "resource"))
                {
                    $this->loadRoutesFrom(base_path('src/Generated/routes/' . $routesFile->getRelativePathname()));
                }
            }
        }
    }

    public function publishPackage()
    {
        $dir = __DIR__ . '/../';

        // publish the config
        $this->publishes([
            $dir . 'config/laravel-scaffolder.php' => config_path('laravel-scaffolder.php'),
        ], 'config');

        // publish the views
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadFromPackage();
        $this->publishPackage();

    }

}
