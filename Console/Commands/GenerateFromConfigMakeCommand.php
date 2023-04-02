<?php

namespace Api\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateFromConfigMakeCommand extends Command
{



    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:generator-conf {--fresh}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generator project from config file';


    public function handle()
    {

        if ($this->option('fresh')) {
            File::deleteDirectory(
                \Api\Providers\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH']
            );
        }


        $resources = \Api\Providers\ScaffolderConfigServiceProvider::getScaffoldConfig()['resources'];

        $package_key = \Api\Providers\ScaffolderConfigServiceProvider::getScaffoldConfigKey();

        foreach ($resources as $resource => $resourceData) {

            // ------------------------------------------

            $cmd = "php artisan maker:validation-rules $resource --conf";

            shell_exec($cmd);

            echo "validation-rules $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan maker:factory $resource --conf";

            shell_exec($cmd);

            echo "factory $resource" . PHP_EOL;

            // ------------------------------------------

            $cmd = "php artisan maker:resource $resource --conf";

            shell_exec($cmd);

            echo "resource $resource" . PHP_EOL;

            // ------------------------------------------

            $cmd = "php artisan maker:model $resource --conf";

            shell_exec($cmd);

            echo "model $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan maker:route $resource ";

            shell_exec($cmd);

            echo "route $resource" . PHP_EOL;

            $cmd = "php artisan maker:route $resource --route-api ";

            shell_exec($cmd);

            echo "route api $resource" . PHP_EOL;

            // ------------------------------------------

            $cmd = "php artisan maker:route-resource $resource";

            shell_exec($cmd);

            echo "route-resource $resource" . PHP_EOL;


            $cmd = "php artisan maker:route-resource $resource --route-api ";

            shell_exec($cmd);

            echo "route-resource api $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan maker:controller-api $resource --conf";

            shell_exec($cmd);

            echo "controller-api $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan maker:swagger";

            shell_exec($cmd);

            echo "swagger $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan maker:controller $resource $package_key::backoffice";

            shell_exec($cmd);

            echo "controller $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan maker:views layout layout backoffice $package_key";

            shell_exec($cmd);

            $cmd = "php artisan maker:views layout header backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan maker:views layout footer backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan maker:views layout home backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan maker:views $resource index backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan maker:views $resource show backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan maker:views $resource create backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan maker:views $resource edit backoffice $package_key";
            shell_exec($cmd);

            echo "views $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan maker:migration $resource --migration_action_create";

            shell_exec($cmd);

            echo "migration $resource" . PHP_EOL;

            // ------------------------------------------

            $cmd = "php artisan maker:seeder $resource  --conf";

            shell_exec($cmd);

            echo "seeder $resource" . PHP_EOL;

        }

    }

}
