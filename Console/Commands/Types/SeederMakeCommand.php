<?php

namespace Api\Console\Commands\Types;

use Api\Console\Commands\AbstractMakeCommand;

use Illuminate\Support\Str;

class SeederMakeCommand extends AbstractMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maker:seeder {model}';

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

        $this->replaceData ['{{ model }}'] =  "\Api\Generated\Models\\" . $this->className;

        $this->replaceData ['{{ datas }}'] =  "'test'       => 'test',";

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
