<?php

namespace Api\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

class GenerateFromConfigMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:generator-conf';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'conf gene';



    public function handle()
    {
        $scaffold = config('scaffolder');

        $resources = $scaffold['resources'];


        foreach ($resources as $resource => $resourceData)
        {

            $cmd = "php artisan make:generator $resource --export --model --controller --controller-api  --validation-rules --factory --migration --seeder --swagger --resource --views --route --route-resource";

            $output = shell_exec($cmd);
            echo "<pre>$output</pre>";

        }

    }

}
