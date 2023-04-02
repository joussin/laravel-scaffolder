<?php

namespace SJoussin\LaravelScaffolder\Console\Commands\Types;

use SJoussin\LaravelScaffolder\Console\Commands\AbstractMakeCommand;
use Illuminate\Support\Str;

class SeederMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:seeder {model} {--conf : Create seeder from conf}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'seeder generator description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->className = Str::studly($this->argument('model'));

        $this->replaceData ['{{ model }}'] = "\\" . \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['PACKAGE_NAMESPACE'] .  "Models\\" . $this->className;


        $properties = "";

        if ($this->option('conf')) {

            $config = \SJoussin\LaravelScaffolder\ScaffolderConfigServiceProvider::getScaffoldConfig()['resources'][$this->className];

            foreach ($config['attributes'] as $name => $data) {
                if ($name == "id") continue;
                $default = $data["default_seeder"];
                $default = is_null($default) ? "null" : "'$default'";
                $properties .= "           '$name'" . ' => ' . $default . "," . PHP_EOL . PHP_EOL;
            }
        }

        $this->replaceData ['{{ datas }}'] = $properties ;

        return parent::handle();
    }

    protected $generatedFileName = null;

    protected $fileExtension = ".php";

    protected $className;

    protected $classNameSuffix = "Seeder";

    protected $stubFilename = "seeder.stub";

    protected $classNamespace = "Database\\Seeders";

    protected $classFilePath = "Database/Seeders/";

}
