<?php

namespace SJoussin\LaravelScaffolder;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\ArgvInput;

class InstallScaffolderServiceProvider extends ServiceProvider
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

        if ($this->app->runningInConsole()) {

            $this->publishPackageResources();
        }
    }

    public function publishPackageResources()
    {

        echo PHP_EOL;
        echo "publish InstallScaffolderServiceProvider::publishPackageResources() : ";


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



        // publish the migrations
        $this->publishes([
            \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH'] . 'Database/Migrations/' => base_path("database/migrations"),
        ], 'migrations');


        // --------------
        // A voir pour surcharge : controllers, models, http_resources, validator_rules


    }



}
