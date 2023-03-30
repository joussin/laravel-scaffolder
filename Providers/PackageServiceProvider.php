<?php

namespace Api\Providers;

use Api\Generated\Database\Seeders\AddressSeeder;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
                \Api\Console\Commands\Migrations\MigrationsMakeCommand::class,

                \Api\Console\Commands\GenerateFromConfigMakeCommand::class,

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

        $this->app->register(PublishesServiceProvider::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        JsonResource::withoutWrapping(); // pour les resources

        //config
        $this->mergeConfigFrom(base_path("src/config/laravel-scaffolder.php"), "laravel-scaffolder");

        // routes
        $this->loadRoutesFrom(base_path('src/Generated/routes/routes-swagger.php' ));

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

}
