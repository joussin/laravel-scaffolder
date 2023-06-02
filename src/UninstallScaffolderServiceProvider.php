<?php

namespace SJoussin\LaravelScaffolder;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\ArgvInput;

class UninstallScaffolderServiceProvider extends ServiceProvider
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

            $this->unpublishPackageResources();
        }
    }

    public function unpublishPackageResources()
    {

        if((new ArgvInput())->getParameterOption('--tag') != "unpublish")
        {
            return;
        }

        $package_key = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfigKey();

        // unpublish the views
        if(File::isDirectory( base_path("resources/views/$package_key") ))
        {
            File::deleteDirectory( base_path("resources/views/$package_key") );
        }

        // unpublish the swagger to public
        if(File::isDirectory( public_path("$package_key") ))
        {
            File::deleteDirectory( public_path("$package_key") );
        }

        // unpublish the routes
        if(File::isDirectory( base_path("routes/$package_key")))
        {
            File::deleteDirectory( base_path("routes/$package_key"));
        }

        // unpublish the migrations
        if(File::isDirectory( base_path("database/migrations") ))
        {
//            File::deleteDirectory( base_path("database/migrations") );
        }
    }


}
