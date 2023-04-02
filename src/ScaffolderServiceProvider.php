<?php

namespace SJoussin\LaravelScaffolder;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ScaffolderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->commands(
            [
                \SJoussin\LaravelScaffolder\Console\Commands\Migrations\MigrationsMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\GenerateFromConfigMakeCommand::class,

                \SJoussin\LaravelScaffolder\Console\Commands\Types\ValidationRulesMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\ModelMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\ControllerMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\ControllerApiMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\FactoryMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\MigrationMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\SeederMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\SwaggerMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\ResourceMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\ViewMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\RouteMakeCommand::class,
                \SJoussin\LaravelScaffolder\Console\Commands\Types\RouteResourceMakeCommand::class,
            ]
        );

        $this->app->register(ScaffolderConfigServiceProvider::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        JsonResource::withoutWrapping();


        if ($this->app->runningInConsole()) {
            $this->publishPackageResources();
        }

        $this->loadPackageResources();
    }


    public function publishPackageResources()
    {
        $package_key = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfigKey();

        // publish the views
        $this->publishes([
            \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . "resources/views/$package_key/" => base_path("resources/views/$package_key"),
        ], 'views');


        // publish the swagger to public
        $this->publishes([
            \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . 'public/api/docs/' => public_path("$package_key/api/docs/"),
        ], 'swagger');


        // publish the routes
        $this->publishes([
            \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . 'routes/' => base_path("routes/$package_key"),
        ], 'routes');

    }

    public function loadPackageResources()
    {
        $package_key = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfigKey();

        // views
        $views_namespace_path_from_laravel = resource_path("views/$package_key");
        $views_namespace_path_from_package = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . ("resources/views/$package_key");

        if(File::isDirectory($views_namespace_path_from_laravel))
        {
            $this->loadViewsFrom($views_namespace_path_from_laravel, "$package_key");
        }
        else {
            $this->loadViewsFrom($views_namespace_path_from_package, "$package_key");
        }


        // swagger
        $routes_swagger_path_from_laravel = base_path("routes/$package_key/routes-swagger.php");
        $routes_swagger_path_from_package = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . ('routes/routes-swagger.php' );

        if(File::isFile($routes_swagger_path_from_laravel)){
            $this->loadRoutesFrom($routes_swagger_path_from_laravel);
        }
        elseif(File::isFile($routes_swagger_path_from_package)){
            $this->loadRoutesFrom($routes_swagger_path_from_package);
        }

        // routes
        $generated_route_dir_from_laravel = base_path("routes/$package_key/");
        $generated_route_dir_from_package = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . ("routes/");

        $generated_route_dir = null;

        if (File::isDirectory($generated_route_dir_from_laravel)) {
            $generated_route_dir = $generated_route_dir_from_laravel;
        }
        elseif (File::isDirectory($generated_route_dir_from_package)) {
            $generated_route_dir = $generated_route_dir_from_package;
        }


        if (File::isDirectory($generated_route_dir)) {
            $routesFiles = File::files(($generated_route_dir));

            foreach ($routesFiles as $routesFile) {

                if(\SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['USE_ROUTES_RESOURCE'] && Str::contains($routesFile->getRelativePathname(), "resource"))
                {
                    $this->loadRoutesFrom(
                        $generated_route_dir . $routesFile->getRelativePathname()
                    );
                } else if(!\SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['USE_ROUTES_RESOURCE'] && !Str::contains($routesFile->getRelativePathname(), "resource"))
                {
                    $this->loadRoutesFrom(
                        $generated_route_dir . $routesFile->getRelativePathname()
                    );
                }

            }
        }
    }
}
