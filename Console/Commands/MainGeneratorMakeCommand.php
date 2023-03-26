<?php

namespace Api\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:generator')]
class MainGeneratorMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:generator {resource}
                           {--export : export to laravel project ? }
                           {--model : Create model class}
                            {--controller : Create controller class}
                            {--controller-api : Create controller-api class}
                            {--validation-rules : Create validation-rules class}
                            {--factory : Create Factory class}
                            {--migration : Create Migration class}
                            {--seeder : Create seeder class}
                            {--swagger : Create swagger json doc}
                            {--resource : Create resource class}
                            {--views : Create views files}
                            {--route : Create route files}
                            {--route-resource : Create route-resource files}
                            ';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Main generator';






    public function handle()
    {
        $resource = Str::studly($this->argument('resource'));



        $export = false;


        if ($this->option('export')) {
                $export = true;
        }


        if ($this->option('model')) {
                Artisan::call("maker:model $resource");
        }


        if ($this->option('controller')) {
            Artisan::call("maker:controller $resource");
        }

        if ($this->option('controller-api')) {
            Artisan::call("maker:controller-api $resource");
        }


        if ($this->option('validation-rules')) {
                Artisan::call("maker:validation-rules $resource");
        }


        if ($this->option('factory')) {
                Artisan::call("maker:factory $resource");
        }



        if ($this->option('migration')) {
                Artisan::call("maker:migration $resource --migration_action_create");
        }

        if ($this->option('seeder')) {
                Artisan::call("maker:seeder $resource");
        }


        if ($this->option('swagger')) {
            if($export) {
                Artisan::call("maker:swagger  --swagger_to_public");
            }
            else{
                Artisan::call("maker:swagger");
            }
        }


        if ($this->option('resource')) {
                Artisan::call("maker:resource $resource");
        }


        if ($this->option('views')) {

            if($export)
            {
                Artisan::call("maker:views $resource layout --move_views_to_resources");
                Artisan::call("maker:views $resource header --move_views_to_resources");
                Artisan::call("maker:views $resource footer --move_views_to_resources");
                Artisan::call("maker:views $resource index --move_views_to_resources");
            }
            else {
                Artisan::call("maker:views $resource layout ");
                Artisan::call("maker:views $resource header ");
                Artisan::call("maker:views $resource footer ");
                Artisan::call("maker:views $resource index ");
            }
        }

        if ($this->option('route')) {
                Artisan::call("maker:route $resource");
                Artisan::call("maker:route $resource --route_api");
        }


        if ($this->option('route-resource')) {
                Artisan::call("maker:route-resource $resource");
                Artisan::call("maker:route-resource $resource --route_api");
        }

    }

}
