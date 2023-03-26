<?php

namespace Api\Console\Commands\Types;

use Api\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class ResourceMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:resource {model}';

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

        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "Resource";

    protected $stubFilename = "laravel/resource.stub";

    protected $classNamespace = "Http\\Resources";

    protected $classFilePath = "Http/Resources/";


}
