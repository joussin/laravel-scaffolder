<?php

namespace SJoussin\LaravelScaffolder\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateFromConfigCommand extends Command
{



    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:all {--fresh}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Project generator from config file';


    public function handle()
    {

        if ($this->option('fresh')) {
            File::deleteDirectory(
                \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['DIST_DIR_PATH']
            );
        }


        $resources = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['resources'];

        $package_key = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfigKey();

        foreach ($resources as $resource => $resourceData) {

            // ------------------------------------------

            $cmd = "php artisan scaffold:validation-rules $resource --conf";

            shell_exec($cmd);

            echo "validation-rules $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan scaffold:factory $resource --conf";

            shell_exec($cmd);

            echo "factory $resource" . PHP_EOL;

            // ------------------------------------------

            $cmd = "php artisan scaffold:resource $resource --conf";

            shell_exec($cmd);

            echo "resource $resource" . PHP_EOL;

            // ------------------------------------------

            $cmd = "php artisan scaffold:model $resource --conf";

            shell_exec($cmd);

            echo "model $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan scaffold:route $resource ";

            shell_exec($cmd);

            echo "route $resource" . PHP_EOL;

            $cmd = "php artisan scaffold:route $resource --route-api ";

            shell_exec($cmd);

            echo "route api $resource" . PHP_EOL;

            // ------------------------------------------

            $cmd = "php artisan scaffold:route-resource $resource";

            shell_exec($cmd);

            echo "route-resource $resource" . PHP_EOL;


            $cmd = "php artisan scaffold:route-resource $resource --route-api ";

            shell_exec($cmd);

            echo "route-resource api $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan scaffold:controller-api $resource --conf";

            shell_exec($cmd);

            echo "controller-api $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan scaffold:swagger";

            shell_exec($cmd);

            echo "swagger $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan scaffold:controller $resource $package_key::backoffice";

            shell_exec($cmd);

            echo "controller $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan scaffold:views layout layout backoffice $package_key";

            shell_exec($cmd);

            $cmd = "php artisan scaffold:views layout header backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan scaffold:views layout footer backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan scaffold:views layout home backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan scaffold:views $resource index backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan scaffold:views $resource show backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan scaffold:views $resource create backoffice $package_key";
            shell_exec($cmd);

            $cmd = "php artisan scaffold:views $resource edit backoffice $package_key";
            shell_exec($cmd);

            echo "views $resource" . PHP_EOL;


            // ------------------------------------------

            $cmd = "php artisan scaffold:migrations $resource --migration_action_create";

            shell_exec($cmd);

            echo "migration $resource" . PHP_EOL;

            // ------------------------------------------

            $cmd = "php artisan scaffold:seeder $resource  --conf";

            shell_exec($cmd);

            echo "seeder $resource" . PHP_EOL;

        }

    }

}
