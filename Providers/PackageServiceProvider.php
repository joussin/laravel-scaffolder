<?php

namespace Api\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
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
                \Api\Console\Commands\GenerateFromConfigMakeCommand::class,
                \Api\Console\Commands\MainGeneratorMakeCommand::class,
                \Api\Console\Commands\Types\ValidationRulesMakeCommand::class,
                \Api\Console\Commands\Types\ModelMakeCommand::class,
                \Api\Console\Commands\Types\ControllerMakeCommand::class,
                \Api\Console\Commands\Types\ControllerApiMakeCommand::class,
                \Api\Console\Commands\Types\FactoryMakeCommand::class,
                \Api\Console\Commands\Types\MigrationMakeCommand::class,
                \Api\Console\Commands\Types\SeederMakeCommand::class,
                \Api\Console\Commands\Types\SwaggerMakeCommand::class,
                \Api\Console\Commands\Types\ResourceMakeCommand::class,
                \Api\Console\Commands\Types\ViewMakeCommand::class,
                \Api\Console\Commands\Types\RouteMakeCommand::class,
                \Api\Console\Commands\Types\RouteResourceMakeCommand::class,
            ]
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutes();



    }


    public function loadRoutes()
    {
        $generated_route_dir = "src/Generated/routes/";

        if(  File::isDirectory($generated_route_dir))
        {
            $routesFiles = File::files(base_path($generated_route_dir));


            foreach ($routesFiles as $routesFile) {
                $this->loadRoutesFrom(
                    $routesFile
                );
            }

        }

    }
}
