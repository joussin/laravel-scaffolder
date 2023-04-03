<?php

namespace SJoussin\LaravelScaffolder;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ScaffolderConfigServiceProvider extends ServiceProvider
{

    /**
     * \SJoussin\LaravelScaffolderProviders\ConfigServiceProvider::getScaffoldDirname()
     *
     * @return mixed
     */
    public static function getScaffoldDirname(): mixed
    {
        return __DIR__ ;
        return env('PACKAGE_DIR_NAME');
    }
    /**
     * \SJoussin\LaravelScaffolderProviders\ConfigServiceProvider::getScaffoldDistDirname()
     *
     * @return mixed
     */
    public static function getScaffoldDistDirname(): mixed
    {
        return env('PACKAGE_DIST_DIR_NAME');
    }

    /**
     * \SJoussin\LaravelScaffolderProviders\ConfigServiceProvider::getScaffoldConfigKey()
     *
     * @return mixed
     */
    public static function getScaffoldConfigKey(): mixed
    {
        return env('PACKAGE_CONFIG_KEY');
    }


    /**
     * \SJoussin\LaravelScaffolderProviders\ConfigServiceProvider::getScaffoldConfig()
     *
     * @return mixed
     */
    public static function getScaffoldConfig(): mixed
    {
        return config(self::getScaffoldConfigKey());
    }

    public function loadConfig()
    {
        $key = self::getScaffoldConfigKey();

        if(File::isFile(base_path("config/$key.php"))){
            $this->mergeConfigFrom(base_path("config/$key.php"), $key);
        }
        elseif(File::isFile((__DIR__."/config/$key.php"))){
            $this->mergeConfigFrom((__DIR__."/config/$key.php"), $key);
        }
    }

    public function publishConfig()
    {
        $key = self::getScaffoldConfigKey();

        $this->publishes([
            (__DIR__."/config/$key.php") => config_path("$key.php"),
        ], 'config');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadConfig();
        $this->publishConfig();
    }

}
