<?php

namespace Api\Providers;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Schema;
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

        $this->app->register(PublishServiceProvider::class);

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
    }

}
