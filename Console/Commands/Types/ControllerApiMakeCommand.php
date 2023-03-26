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
    protected $signature = 'maker:controller-api {model}';

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

        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "ApiController";

    protected $stubFilename = "laravel/controller.api.stub";


    protected $classNamespace = "Http\\Controllers";

    protected $classFilePath = "Http/Controllers/";


}
