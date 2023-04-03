<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Types;

use SJoussin\LaravelScaffolder\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class FactoryMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:factory {model}
    {--conf : Create factory from conf}';

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
        $this->replaceData ['{{ factoryNamespace }}'] = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['PACKAGE_NAMESPACE'] . "Database\\Factories" ;
        //\Illuminate\Database\Eloquent\Factories\Factory<\{{ namespacedModel }}>
        $this->replaceData ['{{ namespacedModel }}'] = "" ;
        // class {{ factory }}Factory extends Factory
        $this->replaceData ['{{ factory }}'] = $this->className ;


        $this->replaceData ['{{ model }}'] = "\\" . \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['PACKAGE_NAMESPACE'] . "Models\\" . $this->className ;
        $properties = "";

        if ($this->option('conf')) {

            $config = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['resources'][$this->className];

            foreach ($config['attributes'] as $name => $data) {
                if ($name == "id") continue;
                $default = $data["default"];
                $default = is_null($default) ? "null" : "'$default'";
                $properties .= "           '$name'" . ' => ' . $default . "," . PHP_EOL . PHP_EOL;
            }
        }

        $this->replaceData ['{{ properties }}'] = $properties ;

        return parent::handle();
    }
    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "Factory";

    protected $stubFilename = "factory.stub";

    protected $classNamespace = "Factories";

    protected $classFilePath = "Database/Factories/";


}
