<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Types;

use SJoussin\LaravelScaffolder\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class RouteMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:route {model}
                            {--route-api : create routes api}

    ';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'routes files generator';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->className = Str::studly($this->argument('model'));

        $resourceName = strtolower($this->className);

        $controllerNamespace = "\\" . \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['PACKAGE_NAMESPACE']   . "Http\\Controllers\\";

        $resourceControllerName = $controllerNamespace .  $this->className . "Controller";

        // routes

        $this->replaceData ['{{ middlewares }}'] = "'web'" ; // 'api', 'web', 'other:scope scopes'
        $this->replaceData ['{{ prefix }}'] = "''" ;


        $this->replaceData ['{{ controller_name }}'] = $resourceControllerName ;
        $this->replaceData ['{{ model_name_singular_variable }}'] = "{id}" ;
        $this->replaceData ['{{ route_id_clause }}'] = "" ;
        $this->replaceData ['{{ model_name_snake }}'] = "$resourceName" ;

        $this->replaceData ['{{ index_route_name }}'] = "list.$resourceName.front" ;
        $this->replaceData ['{{ create_route_name }}'] = "create.$resourceName.front" ;
        $this->replaceData ['{{ show_route_name }}'] = "show.$resourceName.front" ;
        $this->replaceData ['{{ edit_route_name }}'] = "edit.$resourceName.front" ;
        $this->replaceData ['{{ store_route_name }}'] = "store.$resourceName.front" ;
        $this->replaceData ['{{ update_route_name }}'] = "update.$resourceName.front" ;
        $this->replaceData ['{{ destroy_route_name }}'] = "destroy.$resourceName.front" ;

        $this->generatedFileName = $resourceName . '-routes';

        if ($this->option('route-api') ) {

            // routes-api

            $this->stubFilename = "api-routes.stub";

            $this->replaceData ['{{ middlewares }}'] = "'web', 'api'" ;  // 'api', 'web', 'other:scope scopes'
            $this->replaceData ['{{ prefix }}'] = "'api'" ;


            $resourceControllerName = $controllerNamespace . $this->className . "ApiController";
            $this->replaceData ['{{ controller_name }}'] = $resourceControllerName ;


            $this->replaceData ['{{ index_route_name }}'] = "list.$resourceName.api" ;
            $this->replaceData ['{{ show_route_name }}'] = "show.$resourceName.api" ;
            $this->replaceData ['{{ store_route_name }}'] = "store.$resourceName.api" ;
            $this->replaceData ['{{ update_route_name }}'] = "update.$resourceName.api" ;
            $this->replaceData ['{{ destroy_route_name }}'] = "destroy.$resourceName.api" ;

            $this->generatedFileName = $resourceName . '-routes-api';
        }

        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "";

    protected $stubFilename = "routes.stub";

    protected $classNamespace = "";

    protected $classFilePath = "routes/";


}
