<?php

namespace Api\Console\Commands\Types;

use Api\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class RouteResourceMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:route-resource {model}
                            {--route_api : create routes api}

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

        $controllerNamespace = "\\" . self::MAIN_NAMESPACE  . "Http\\Controllers\\";


        // routes
        $resourceControllerName = $controllerNamespace .  $this->className . "Controller";

        $this->replaceData ['{{ controller_name }}'] = $resourceControllerName ;
        $this->replaceData ['{{ model_name_snake }}'] = "$resourceName" ;


        $this->generatedFileName = $resourceName . '-routes-resource';

        if ($this->option('route_api') ) {

            // routes-api

            $this->stubFilename = "api-routes-resource.stub";

            $resourceControllerName = $controllerNamespace . $this->className . "ApiController";
            $this->replaceData ['{{ controller_name }}'] = $resourceControllerName ;
            $this->replaceData ['{{ model_name_snake }}'] = "$resourceName" ;

            $this->generatedFileName = $resourceName . '-routes-api-resource';
        }

        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "";

    protected $stubFilename = "routes-resource.stub";

    protected $classNamespace = "";

    protected $classFilePath = "routes/";


}
