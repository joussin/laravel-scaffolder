<?php

namespace Api\Console\Commands\Types;

use Api\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class FactoryMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:factory {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'factory generator description';


  /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->className = Str::studly($this->argument('model'));

        // namespace {{ factoryNamespace }};
        $this->replaceData ['{{ factoryNamespace }}'] = self::MAIN_NAMESPACE . "Database\\Factories" ;
        //\Illuminate\Database\Eloquent\Factories\Factory<\{{ namespacedModel }}>
        $this->replaceData ['{{ namespacedModel }}'] = "" ;
        // class {{ factory }}Factory extends Factory
        $this->replaceData ['{{ factory }}'] = $this->className ;


        return parent::handle();
    }
    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "Factory";

    protected $stubFilename = "laravel/factory.stub";

    protected $classNamespace = "Factories";

    protected $classFilePath = "Database/Factories/";


}
