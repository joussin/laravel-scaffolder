<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Types;

use SJoussin\LaravelScaffolder\Console\Commands\AbstractMakeCommand;

class ModelMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:model {model}
                            {--conf : Create model from conf}';

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
        $this->className = $this->argument('model');

        $fillable = "";
        $properties = "";
        $connection = "mysql";
        $table = strtolower($this->className);
        $factoryClass = "";

        if ($this->option('conf')) {

            $config = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['resources'][$this->className];


            foreach ($config['attributes'] as $name => $data)
            {
                $properties .= '    protected ' . $data['type'] . ' $' .$name.';' . PHP_EOL. PHP_EOL;
                $fillable .= "'$name',";
            }

            $connection = $config['connection'] ;
            $table = $config['table'] ;

            $package_namespace = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['PACKAGE_NAMESPACE'];

            $factoryClass = 'return '.$package_namespace.'Database\Factories\\'.$this->className.'Factory::new();' ;

        }

        $this->replaceData ['{{ connection }}'] = $connection;
        $this->replaceData ['{{ table }}'] = $table;
        $this->replaceData ['{{ factoryClass }}'] = $factoryClass;


        $this->replaceData ['{{ properties }}'] = $properties ;
        $this->replaceData ['{{ fillable }}'] = $fillable ;


        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "";

    protected $stubFilename = "model.stub";

    protected $classNamespace = "Models";

    protected $classFilePath = "Models/";


}
