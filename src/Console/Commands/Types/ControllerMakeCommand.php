<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Types;

use SJoussin\LaravelScaffolder\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class ControllerMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:controller {model} {views_namespace}

    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'controller generator description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->className = Str::studly($this->argument('model'));

        $viewNamespace = $this->argument('views_namespace');

        $this->replaceData ['{{ viewNamespace }}'] =  $viewNamespace;
        $this->replaceData ['{{ model }}'] = strtolower($this->className) ;


        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "Controller";

    protected $stubFilename = "controller.stub";


    protected $classNamespace = "Http\\Controllers";

    protected $classFilePath = "Http/Controllers/";


}
