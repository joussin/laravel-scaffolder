<?php

namespace Api\Console\Commands\Types;

use Api\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class ModelMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:model {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Model generator description';


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

    protected $classNameSuffix = "";

    protected $stubFilename = "laravel/model.stub";

    protected $classNamespace = "Models";

    protected $classFilePath = "Models/";


}
