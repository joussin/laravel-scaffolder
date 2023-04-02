<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Types;

use SJoussin\LaravelScaffolder\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class ResourceMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:resource {model}
     {--conf : Create resource from conf}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'resource generator description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->className = Str::studly($this->argument('model'));

        $properties = "";

        if ($this->option('conf')) {

            $config = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['resources'][$this->className];


            foreach ($config['attributes'] as $name => $data)
            {
                $properties .= "           '$name'" . ' => $this->' . $name .',' . PHP_EOL . PHP_EOL;
            }

        }

        $this->replaceData ['{{ properties }}'] = $properties ;


        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "Resource";

    protected $stubFilename = "resource.stub";

    protected $classNamespace = "Http\\Resources";

    protected $classFilePath = "Http/Resources/";


}
