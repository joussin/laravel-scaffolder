<?php

namespace Api\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

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
    protected $description = 'conf gene';



    public function handle()
    {
        if ($this->option('fresh')) {
            File::deleteDirectory(
                base_path("src/Generated/")
            );
        }

        $scaffold = config('laravel-scaffolder');

        $resources = $scaffold['resources'];

        foreach ($resources as $resource => $resourceData)
        {

//            $cmd = "php artisan make:generator $resource --export --model --views --controller --controller-api  --validation-rules --factory --migration --seeder --swagger --resource --route --route-api --route-resource";

            /** ------------------------------------------ */

            $cmd = "php artisan maker:validation-rules $resource --conf";

            shell_exec($cmd);

            echo "validation-rules $resource" . PHP_EOL;

            /** ------------------------------------------ */

            $cmd = "php artisan maker:factory $resource --conf";

            shell_exec($cmd);

            echo "factory $resource" . PHP_EOL;

            /** ------------------------------------------ */

            $cmd = "php artisan maker:resource $resource --conf";

            shell_exec($cmd);

            echo "resource $resource" . PHP_EOL;

            /** ------------------------------------------ */

            $cmd = "php artisan maker:model $resource --conf";

            shell_exec($cmd);

            echo "model $resource" . PHP_EOL;


            /** ------------------------------------------ */

            $cmd = "php artisan maker:route $resource ";

            shell_exec($cmd);

            echo "route $resource" . PHP_EOL;

            $cmd = "php artisan maker:route $resource --route-api ";

            shell_exec($cmd);

            echo "route api $resource" . PHP_EOL;

            /** ------------------------------------------ */

            $cmd = "php artisan maker:route-resource $resource";

            shell_exec($cmd);

            echo "route-resource $resource" . PHP_EOL;


            $cmd = "php artisan maker:route-resource $resource --route-api ";

            shell_exec($cmd);

            echo "route-resource api $resource" . PHP_EOL;


            /** ------------------------------------------ */

            $cmd = "php artisan maker:controller $resource";

            shell_exec($cmd);

            echo "controller $resource" . PHP_EOL;



            /** ------------------------------------------ */

            $cmd = "php artisan maker:controller-api $resource --conf";

            shell_exec($cmd);

            echo "controller-api $resource" . PHP_EOL;



            /** ------------------------------------------ */

            $cmd = "php artisan maker:swagger --swagger_to_public";

            shell_exec($cmd);

            echo "swagger $resource" . PHP_EOL;



            /** ------------------------------------------ */

            $cmd = "php artisan maker:views layout layout backoffice --move_views_to_resources";

            shell_exec($cmd);

            $cmd = "php artisan maker:views layout header backoffice --move_views_to_resources";
            shell_exec($cmd);

            $cmd = "php artisan maker:views layout footer backoffice --move_views_to_resources";
            shell_exec($cmd);

            $cmd = "php artisan maker:views layout home backoffice --move_views_to_resources";
            shell_exec($cmd);

            $cmd = "php artisan maker:views $resource index backoffice --move_views_to_resources";
            shell_exec($cmd);

            $cmd = "php artisan maker:views $resource show backoffice --move_views_to_resources";
            shell_exec($cmd);

            $cmd = "php artisan maker:views $resource create backoffice --move_views_to_resources";
            shell_exec($cmd);

            $cmd = "php artisan maker:views $resource edit backoffice --move_views_to_resources";
            shell_exec($cmd);

            echo "views $resource" . PHP_EOL;


            /** ------------------------------------------ */

            $cmd = "php artisan maker:migration $resource --migration_action_create";

            shell_exec($cmd);

            echo "migration $resource" . PHP_EOL;

            /** ------------------------------------------ */

            $cmd = "php artisan maker:seeder $resource  --conf";

            shell_exec($cmd);

            echo "seeder $resource" . PHP_EOL;

        }

    }

}
