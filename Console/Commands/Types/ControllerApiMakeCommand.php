<?php

namespace Api\Console\Commands\Types;

use Api\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class ControllerApiMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:controller-api {model}
    {--conf : : Create controller api from conf}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'controller-api generator description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->className = Str::studly($this->argument('model'));


        $properties_post = "";
        $properties_put = "";

        $resource = "" ;
        $validationRules = "" ;
        $model = "" ;


        if ($this->option('conf')) {

            $config = \Api\Providers\ScaffolderConfigServiceProvider::getScaffoldConfig()['resources'][$this->className];


            foreach ($config['attributes'] as $name => $data)
            {
                if ($name == "id") continue;
                $properties_post .= "'$name'".' => $request->post(\''.$name.'\'),' . PHP_EOL. PHP_EOL;
                $properties_put .= "'$name'" ."," . PHP_EOL. PHP_EOL;
            }

            $resource = "\\" . \Api\Providers\ScaffolderConfigServiceProvider::getScaffoldConfig()['PACKAGE_NAMESPACE'] . "Http\Resources\\" . $this->className."Resource" ;
            $validationRules = "\\" . \Api\Providers\ScaffolderConfigServiceProvider::getScaffoldConfig()['PACKAGE_NAMESPACE'] . "ValidationRules\\" . $this->className."ValidationRules" ;
            $model = "\\" . \Api\Providers\ScaffolderConfigServiceProvider::getScaffoldConfig()['PACKAGE_NAMESPACE'] . "Models\\" . $this->className ;

        }


        $this->replaceData ['{{ properties_post }}'] = $properties_post ;
        $this->replaceData ['{{ properties_put }}'] = $properties_put ;

        $this->replaceData ['{{ model }}'] = $model ;
        $this->replaceData ['{{ resource }}'] = $resource;
        $this->replaceData ['{{ validationRules }}'] = $validationRules;


        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "ApiController";

    protected $stubFilename = "controller.api.stub";


    protected $classNamespace = "Http\\Controllers";

    protected $classFilePath = "Http/Controllers/";


}
