<?php

namespace Api\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ScaffolderConfigServiceProvider extends ServiceProvider
{

    /**
     * \Api\Providers\ConfigServiceProvider::getScaffoldDirname()
     *
     * @return mixed
     */
    public static function getScaffoldDirname(): mixed
    {
        return env('PACKAGE_DIR_NAME');
    }
    /**
     * \Api\Providers\ConfigServiceProvider::getScaffoldDistDirname()
     *
     * @return mixed
     */
    public static function getScaffoldDistDirname(): mixed
    {
        return env('PACKAGE_DIST_DIR_NAME');
    }

    /**
     * \Api\Providers\ConfigServiceProvider::getScaffoldConfigKey()
     *
     * @return mixed
     */
    public static function getScaffoldConfigKey(): mixed
    {
        return env('PACKAGE_CONFIG_KEY');
    }


    /**
     * \Api\Providers\ConfigServiceProvider::getScaffoldConfig()
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
        elseif(File::isFile(base_path("src/config/$key.php"))){
            $this->mergeConfigFrom(base_path("src/config/$key.php"), $key);
        }
    }

    public function publishConfig()
    {
        $key = self::getScaffoldConfigKey();

        $this->publishes([
            base_path("src/config/$key.php") => config_path("$key.php"),
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
